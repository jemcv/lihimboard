<?php

namespace App\Models;

class Category
{
    private $db;

    public function __construct(\App\Database $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM categories")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($term)
    {
        $stmt = $this->db->query("SELECT * FROM categories WHERE name LIKE :term", ['term' => '%' . $term . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->query("SELECT * FROM categories WHERE category_id = :id", ['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
