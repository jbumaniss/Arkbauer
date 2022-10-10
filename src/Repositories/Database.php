<?php



namespace Src\Repositories;


use PDO;
use Src\Config\Config;

class Database
{

    private string $dbHost;
    private string $dbName;
    private string $dbUsername;
    private string $dbPassword;
    private Config $config;


    public function __construct()
    {
        $this->config = new Config();

        $this->dbHost = $this->config->host();
        $this->dbName = $this->config->databaseName();
        $this->dbUsername = $this->config->username();
        $this->dbPassword = $this->config->password();

    }


    protected function connect() {
        $dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;
        $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }
}