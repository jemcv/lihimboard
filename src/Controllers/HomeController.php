<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController
{
    private $categoryModel;
    private $postModel;

    public function __construct(Category $categoryModel, Post $postModel)
    {
        $this->categoryModel = $categoryModel;
        $this->postModel = $postModel;
    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();
        $posts = $this->postModel->getFirstN(5);
        $mostCommentedPost = $this->postModel->getMostCommentedPost();

        require __DIR__ . '/../Views/index.php';
    }

    public function categories()
    {
        $categories = $this->categoryModel->getAll();
        $data = ['categories' => $categories];

        require __DIR__ . '/../Views/categories_list.php';
    }

    public function about()
    {
        require __DIR__ . '/../Views/about.php';
    }

    public function notFound()
    {
        http_response_code(404);
        require __DIR__ . '/../Views/404.php';
    }
}
