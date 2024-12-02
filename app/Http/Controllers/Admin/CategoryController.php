<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Category\Request as CategoryRequest;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        $categories = $this->categoryService->collection($request);
        return view('admin.pages.category.index', [
            'categories' => $categories
        ]);
    }

    public function create(Request $request){
        return view('admin.pages.category.edit');
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        $categoryObj = $this->categoryService->create($request->validated());
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        $this->authorize('view', Category::class);
        return view('admin.pages.category.show', [
            'category' => $category
        ]);
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $this->authorize('update', Category::class);
        $categoryObj = $this->categoryService->update($category, $request->validated());
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $this->authorize('update', Category::class);
        return view('admin.pages.category.edit', [
            'category' => $category,
        ]);
    }

    public function destroy(Category $category) {
        $this->authorize('delete', Category::class);
        $category = $this->categoryService->destroy($category->id);
        return redirect()->route('categories.index');
    }
}
