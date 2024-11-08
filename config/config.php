<?php

use App\Database;

require_once __DIR__ . '/../vendor/autoload.php';

// Define database configuration
$host = 'localhost';
$dbname = 'lihimboard';
$username = 'root';
$password = '';

// Create a new Database instance
$db = Database::getInstance($host, $dbname, $username, $password);
