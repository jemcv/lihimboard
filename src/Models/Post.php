<?php

namespace App\Models;

class Post
{
    private $db;

    public function __construct(\App\Database $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getByCategoryId($categoryId)
    {
        $stmt = $this->db->query("SELECT * FROM posts WHERE category_id = :category_id ORDER BY created_at DESC", ['category_id' => $categoryId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($postId)
    {
        $stmt = $this->db->query("SELECT * FROM posts WHERE post_id = :post_id", ['post_id' => $postId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $image_url, $category_id, $tripcode)
    {
        $this->db->query("INSERT INTO posts (title, content, image_url, category_id, tripcode) VALUES (:title, :content, :image_url, :category_id, :tripcode)", [
            'title' => $title,
            'content' => $content,
            'image_url' => $image_url,
            'category_id' => $category_id,
            'tripcode' => $tripcode
        ]);
    }
    public function getFirstN($limit)
    {
        $limit = (int) $limit; // Ensure $limit is an integer
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getMostCommentedPost()
    {
        $stmt = $this->db->query("
            SELECT posts.*, COUNT(comments.comment_id) AS comment_count 
            FROM posts 
            LEFT JOIN comments ON posts.post_id = comments.post_id 
            GROUP BY posts.post_id 
            ORDER BY comment_count DESC 
            LIMIT 1
        ");
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByTripcode($tripcode)
    {
        $stmt = $this->db->query("SELECT * FROM posts WHERE tripcode = :tripcode ORDER BY created_at DESC", ['tripcode' => $tripcode]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;

        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countAllPosts()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM posts");
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }
}
