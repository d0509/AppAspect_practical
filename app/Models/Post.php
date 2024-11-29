<?php

namespace App\Models;

use Plank\Mediable\Mediable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Mediable;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'status'
    ];

    protected $queryable = [
        'id'
    ];

    public $relationship = [
        'category' => [
            'model' => Category::class,
        ],
    ];

    protected $scopedFilters = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
