<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class PostController
{
    private $postModel;
    private $commentModel;
    private $categoryModel;

    public function __construct(Post $postModel, Comment $commentModel, Category $categoryModel)
    {
        $this->postModel = $postModel;
        $this->commentModel = $commentModel;
        $this->categoryModel = $categoryModel;
    }

    public function create()
    {
        $categories = $this->categoryModel->getAll();
        $data = ['categories' => $categories];
        require __DIR__ . '/../Views/add.php';
    }

    public function store()
    {
        $postMaxSize = ini_get('post_max_size');
        $maxBytes = $this->convertToBytes($postMaxSize);

        if ($_SERVER['CONTENT_LENGTH'] > $maxBytes) {
            $this->handleError('The submitted data exceeds the maximum allowed size of ' . $postMaxSize . '. Please try again with a smaller file or content.');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title'] ?? '');
            $content = htmlspecialchars($_POST['content'] ?? '');
            $category_id = intval($_POST['category_id'] ?? 0);
            $tripcode = htmlspecialchars($_POST['tripcode'] ?? '');

            $errors = $this->validatePost($title, $content, $category_id, $tripcode);

            if (empty($errors)) {
                $image_url = $this->handleFileUpload($errors);
            }

            if (!empty($errors)) {
                $this->handleError($errors);
                return;
            }

            $this->postModel->create($title, $content, $image_url, $category_id, $tripcode);
            header('Location: /category/' . $category_id);
            exit;
        }
    }

    private function validatePost($title, $content, $category_id, &$tripcode)
    {
        $errors = [];

        if (empty($title)) {
            $errors[] = 'Title is required.';
        }
        if (empty($content)) {
            $errors[] = 'Content is required.';
        }
        if ($category_id <= 0) {
            $errors[] = 'Invalid category.';
        }

        $category = $this->categoryModel->getById($category_id);
        if (!$category) {
            $errors[] = 'Selected category does not exist.';
        }

        if (!empty($tripcode)) {
            $tripcode = $this->generateTripcode($tripcode);
        }

        return $errors;
    }

    private function handleFileUpload(&$errors)
    {
        $image_url = '';
        if (isset($_FILES['image_url'])) {
            if ($_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image_url']['type'], $allowedTypes)) {
                    $errors[] = 'Invalid file type. Allowed types are JPG, PNG, and GIF.';
                }

                if (empty($errors)) {
                    $uploads_dir = __DIR__ . '/../../public/uploads/';
                    $file_extension = pathinfo($_FILES['image_url']['name'], PATHINFO_EXTENSION);
                    $shortened_name = sha1(uniqid()) . '.' . $file_extension;
                    $image_url = '/uploads/' . $shortened_name;

                    if (!move_uploaded_file($_FILES['image_url']['tmp_name'], $uploads_dir . $shortened_name)) {
                        $errors[] = 'Failed to upload the file.';
                    }
                }
            } elseif ($_FILES['image_url']['error'] === UPLOAD_ERR_INI_SIZE) {
                $errors[] = 'The uploaded file exceeds the maximum allowed size.';
            } elseif ($_FILES['image_url']['error'] !== UPLOAD_ERR_NO_FILE) {
                $errors[] = 'File upload error. Please try again.';
            }
        }
        return $image_url;
    }

    private function handleError($errors)
    {
        $categories = $this->categoryModel->getAll();
        $data = ['categories' => $categories, 'errors' => (array)$errors];
        require __DIR__ . '/../Views/add.php';
    }

    private function convertToBytes($size)
    {
        $unit = strtolower(substr($size, -1));
        $bytes = (int) $size;

        switch ($unit) {
            case 'k':
                $bytes *= 1024;
                break;
            case 'm':
                $bytes *= 1024 * 1024;
                break;
            case 'g':
                $bytes *= 1024 * 1024 * 1024;
                break;
        }

        return $bytes;
    }

    public function index($limit = 3)
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $posts = $this->postModel->getPaginated($limit, $offset);
        $totalPosts = $this->postModel->countAllPosts();
        $totalPages = ceil($totalPosts / $limit);

        $data = ['posts' => $posts, 'totalPages' => $totalPages];
        require __DIR__ . '/../Views/posts.php';
    }

    public function show($postId)
    {
        $post = $this->postModel->getById($postId);
        if (!$post) {
            http_response_code(404);
            require __DIR__ . '/../Views/404.php';
            return;
        }
        $comments = $this->commentModel->getByPostId($postId);
        $data = ['post' => $post, 'comments' => $comments];
        require __DIR__ . '/../Views/post.php';
    }

    public function search($tripcode)
    {
        if (strpos($tripcode, 'lihim#') === 0) {
            $tripcode = substr($tripcode, strlen('lihim#'));
        }

        $posts = $this->postModel->getByTripcode($tripcode);
        $data = ['posts' => $posts, 'tripcode' => $tripcode];
        require __DIR__ . '/../Views/search.php';
    }

    private function generateTripcode($password)
    {
        return substr(crypt($password, 'tripcode_salt'), -10);
    }
}
