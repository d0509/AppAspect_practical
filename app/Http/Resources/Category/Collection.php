<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\Category\Resource';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
