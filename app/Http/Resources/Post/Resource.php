<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status
        ];

        if ($this->hasMedia('post')) {
            $data['image'] = $this->firstMedia('post')->getUrl();
        }

        $data['category'] = $this->category ? $this->category->name : '-';

        return $data;
    }
}
