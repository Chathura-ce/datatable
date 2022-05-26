<?php


class Database{
    private $server = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'classicmodels';
    private $port = '3307';
    public $con = null;

    public function __construct()
    {
        $this->createConnection();
    }

    public function createConnection()
    {
        $this->con = mysqli_connect($this->server,$this->username,$this->password,$this->database,$this->port);
    }

}
