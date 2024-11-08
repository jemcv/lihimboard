<?php

namespace App;

use App\ControllerFactory;

 $router->add('/', function () use ($db) {
    ControllerFactory::getHomeController($db)->index();
 });

 $router->add('/about', function () use ($db) {
    ControllerFactory::getHomeController($db)->about();
 });

 $router->add('/search', function () use ($db) {
    $tripcode = $_GET['tripcode'] ?? '';
    ControllerFactory::getPostController($db)->search($tripcode);
 });

 $router->add('/categories', function () use ($db) {
    ControllerFactory::getHomeController($db)->categories();
 });

 $router->add('/category/{id}', function ($categoryId) use ($db) {
    if (is_numeric($categoryId)) {
        ControllerFactory::getCategoryController($db)->show($categoryId);
    } else {
        http_response_code(404);
        ControllerFactory::getHomeController($db)->notFound();
    }
 });

 $router->add('/post', function () use ($db) {
    $postId = $_GET['id'] ?? null;
    if (is_numeric($postId)) {
        ControllerFactory::getPostController($db)->show($postId);
    } else {
        http_response_code(404);
        ControllerFactory::getHomeController($db)->notFound();
    }
 });

 $router->add('/posts', function () use ($db) {
    ControllerFactory::getPostController($db)->index();
 });

 $router->add('/add', function () use ($db) {
    ControllerFactory::getPostController($db)->create();
 });

 $router->add('/store', function () use ($db) {
    ControllerFactory::getPostController($db)->store();
 });

 $router->add('/comment', function () use ($db) {
    ControllerFactory::getCommentController($db)->addComment();
 });

 $router->set404(function () use ($db) {
    http_response_code(404);
    ControllerFactory::getHomeController($db)->notFound();
 });
