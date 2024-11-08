<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController
{
    private $categoryModel;
    private $postModel;

    public function __construct(Category $categoryModel, Post $postModel)
    {
        $this->categoryModel = $categoryModel;
        $this->postModel = $postModel;
    }

    public function show($categoryId)
    {
        $category = $this->categoryModel->getById($categoryId);
        $posts = $this->postModel->getByCategoryId($categoryId);

        $data = [
            'category' => $category,
            'posts' => $posts
        ];

        require __DIR__ . '/../Views/categories.php';
    }

    public function notFound()
    {
        require __DIR__ . '/../Views/404.php';
    }
}
