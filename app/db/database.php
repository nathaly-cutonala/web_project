<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'password';
    private $database = 'expenses';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }/* else{
            die('connected');
        } */
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}