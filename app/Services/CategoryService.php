<?php

namespace App\Services;

use Exception;
use App\Models\Category;

class CategoryService
{

    private $categoryObj;

    public function __construct()
    {
        $this->categoryObj = new Category;
    }

    public function collection($inputs)
    {
        $categories = $this->categoryObj->query();

        $categories = $categories->get();

        return $categories;
    }


    public function create($inputs)
    {
        try {
            $category = $this->categoryObj->create($inputs);

            $data['category'] = $category;
        } catch (Exception $e) {
            $data['error']['message'] = $e->getMessage();
        }

        return $data;
    }


    public function update($category, $inputs)
    {
        try {
            $category->update($inputs);
            $data['category'] = $category;
        } catch (Exception $e) {
            $data['errors']['message'] = $e->getMessage();
        }
        return $data;
    }

    public function destroy(int $id)
    {
        $post = $this->categoryObj->find($id);
        $post->delete();
        $data['message'] = __('entity.entityDeleted', ['entity' => 'Post']);
        return $data;
    }
}
