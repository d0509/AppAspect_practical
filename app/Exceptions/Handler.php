<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception){
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $modelName = last(explode('\\', $exception->getModel()));
            $modelKey = strtolower(preg_replace('/([a-z])([A-Z])/s', '$1_$2', $modelName));
            $modelName = preg_replace('/([a-z])([A-Z])/s', '$1 $2', $modelName);
            $modelName = strtolower($modelName);
            $modelName = ucfirst($modelName);
            $modelName == 'Tender' ? $modelName = 'Job' : $modelName;
            $error['errors']['message'][] = __('entity.entityNotFound', ['entity' => "$modelName data"]);
            $error['message'] = __('entity.entityNotFound', ['entity' => "$modelName data"]);

            return $this->error($error, 404);
        }

        return parent::render($request, $exception);
    }
}
