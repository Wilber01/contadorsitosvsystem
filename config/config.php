<?php
class Database {
    private $host = "localhost";
    private $database = "ContadorcitoDB";
    private $user = "root";
    private $password = "123123";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->database.";charset=utf8", 
                $this->user, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $ex) {
            error_log("Connection error: " . $ex->getMessage());
            die("Database connection failed.");
        }
        return $this->conn;
    }
}
?>