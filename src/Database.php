<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private $connection;
    private static $instance = null;

    private function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance($host, $dbname, $username, $password)
    {
        if (self::$instance === null) {
            self::$instance = new Database($host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new \Exception('Query failed: ' . $e->getMessage());
        }
    }

    public function closeConnection()
    {
        $this->connection = null;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
