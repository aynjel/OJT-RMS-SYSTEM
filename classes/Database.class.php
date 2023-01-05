<?php
class Database {
    protected $hostname = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "ojt_rms_system";
    protected $connection;

    public function __construct() {
        try{
            $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}