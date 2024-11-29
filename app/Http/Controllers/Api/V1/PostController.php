<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\Post\Create;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\Resource;
use App\Http\Resources\Post\Collection;

class PostController extends Controller
{
    use ApiResponser;

    protected $PostService;

    public function __construct(PostService $postService)
    {
        $this->PostService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->PostService->collection($request);
        $posts = new Collection($posts);
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        $post = $this->PostService->create($request->validated());
        if (isset($post['error'])) {
            $data['error']['message'] = $post;
        } else {
            $data['post'] = new Resource($post['post']);
            $data['message'] = 'Post Created Successfully';
        }

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = new Resource($post);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Create $request, Post $post)
    {
        $post = $this->PostService->update($request->validated(), $post);
        if (isset($post['errors'])) {
            $data['error']['message'] = $post['errors'];
        } else {
            $data['post'] = new Resource($post['post']);
            $data['message'] = 'Post updated successfully';
        }

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $category = $this->PostService->destroy($post->id);
        return $this->success($category);
    }
}
