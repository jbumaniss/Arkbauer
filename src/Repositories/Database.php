<?php



namespace Src\Repositories;


use PDO;

class Database
{

    protected function connect() {
        $dsn = "mysql:host=" . $_ENV['HOST'] . ";dbname=" . $_ENV['DATABASE_NAME'];
        $pdo = new PDO($dsn, $_ENV['USERNAME'], $_ENV['PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }
}