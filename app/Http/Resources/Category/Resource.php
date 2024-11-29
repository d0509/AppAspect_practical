<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{

    public function toArray($request)
    {
        $data['name'] = $this->name;
        return $data;
    }
}
