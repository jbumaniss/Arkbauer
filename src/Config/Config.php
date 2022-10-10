<?php


namespace Src\Config;


class Config
{
    private string $username;
    private string $password;
    private string $host;
    private string $databaseName;


    public function __construct()
    {
        $this->username = "root";
        $this->password = "fill_your_password";
        $this->host = "127.0.0.1";
        $this->databaseName = "arkbauer";
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function host(): string
    {
        return $this->host;
    }

    public function databaseName(): string
    {
        return $this->databaseName;
    }
}