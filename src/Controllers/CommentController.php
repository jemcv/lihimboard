<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
    private $commentModel;

    public function __construct(Comment $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
            $commentText = htmlspecialchars(trim($_POST['comment_text'] ?? ''), ENT_QUOTES, 'UTF-8');

            if ($postId !== false && !empty($commentText)) {
                $this->commentModel->create($postId, $commentText);
                header('Location: /post?id=' . $postId);
                exit;
            } else {
                die('Invalid input.');
            }
        }
    }
}
