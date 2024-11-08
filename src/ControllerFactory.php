<?php

namespace App;

use App\Controllers\CategoryController;
use App\Controllers\CommentController;
use App\Controllers\PostController;
use App\Controllers\HomeController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class ControllerFactory
{
    public static function getHomeController($db)
    {
        return new HomeController(new Category($db), new Post($db));
    }

    public static function getPostController($db)
    {
        return new PostController(new Post($db), new Comment($db), new Category($db));
    }

    public static function getCategoryController($db)
    {
        return new CategoryController(new Category($db), new Post($db));
    }

    public static function getCommentController($db)
    {
        return new CommentController(new Comment($db));
    }
}
