<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Request as CategoryRequest;
use App\Http\Resources\Category\Resource as CategoryResource;
use App\Http\Resources\Category\Collection as CategoryCollection;


class CategoryController extends Controller
{
    use ApiResponser;

    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->collection($request->all());
        return $this->collection(new CategoryCollection($categories));
    }

    public function store(CategoryRequest $request)
    {
        $categoryObj = $this->categoryService->create($request->validated());
        if (isset($post['error'])) {
            $data['error']['message'] = $post;
        } else {
            $data['category'] = new CategoryResource($categoryObj['category']);
            $data['message'] = 'Post Created Successfully';
        }
        return $data;
    }

    public function show(Category $category)
    {
        $category = new CategoryResource($category);
        return $category;
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $categoryObj = $this->categoryService->update($category, $request->validated());
        if (isset($post['errors'])) {
            $data['error']['message'] = $post['errors'];
        } else {
            $data['post'] = new CategoryResource($categoryObj['category']);
            $data['message'] = 'Category updated successfully';
        }

        return $data;
    }

    public function destroy(Category $category)
    {
        $category = $this->categoryService->destroy($category->id);
        return $this->success($category);
    }
}
