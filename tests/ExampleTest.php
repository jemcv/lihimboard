<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Database;

class ExampleTest extends TestCase
{
    public function testHelloWorld()
    {
        $this->assertEquals(1 + 1, 2);
    }

    public function testDatabaseConnection()
    {
        $host = 'localhost';
        $dbname = 'lihimboard';
        $username = 'root';
        $password = '';

        $db = Database::getInstance($host, $dbname, $username, $password);
        $this->assertInstanceOf(\PDO::class, $db->getConnection());
    }
}
