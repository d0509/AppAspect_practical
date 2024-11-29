<?php

namespace App\Services;

use Exception;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Facades\MediaUploader;

class PostService
{

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function collection($inputs)
    {
        $posts = $this->post->query();
        if (!empty($inputs['status'])) {
            $posts->where('status', $inputs['status']);
        }

        $posts = $posts->get();

        return $posts;
    }


    public function create($inputs)
    {
        try {
            $post = $this->post->create($inputs);

            // Ensure posts directory exists in public storage
            Storage::disk('public')->makeDirectory('posts');

            if (request()->hasFile('image')) {
                $media = MediaUploader::fromSource(request()->file('image')) // Correctly retrieve the uploaded file
                    ->toDisk('public')
                    ->toDirectory('posts')
                    ->upload();

                $post->attachMedia($media, 'post');
            }

            $data['post'] = $post;
        } catch (Exception $e) {
            $data['error']['message'] = $e->getMessage();
        }

        return $data;
    }


    public function update($inputs, $post)
    {
        try {
            $post->update($inputs);
            if (request()->hasFile('image')) {
                $media = MediaUploader::fromSource(request()->file('image')) // Correctly retrieve the uploaded file
                    ->toDisk('public')
                    ->toDirectory('posts')
                    ->upload();

                $post->syncMedia($media, 'post');

                $data['post'] = $post;
            }
        } catch (Exception $e) {
            $data['errors']['message'] = $e->getMessage();
        }
        return $data;
    }

    public function destroy(int $id)
    {
        $post = $this->post->find($id);
        $post->delete();
        $data['message'] = __('entity.entityDeleted', ['entity' => 'Post']);
        return $data;
    }
}
