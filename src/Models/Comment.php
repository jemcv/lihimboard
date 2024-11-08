<?php

namespace App\Models;

class Comment
{
    private $db;

    public function __construct(\App\Database $db)
    {
        $this->db = $db;
    }

    public function getByPostId($postId)
    {
        $stmt = $this->db->query("SELECT * FROM comments WHERE post_id = :post_id", ['post_id' => $postId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($postId, $commentText)
    {
        $this->db->query("INSERT INTO comments (post_id, comment_text) VALUES (:post_id, :comment_text)", [
            'post_id' => $postId,
            'comment_text' => $commentText
        ]);
    }
}
