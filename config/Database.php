<?php
class Database{
     // DB Params
     private $host = 'localhost:3308';
     private $db_name = 'agpaytech';
     private $username = 'root';
     private $password = 'Solomon123';
     protected $conn;
 
     // DB Connect
     public function __construct(){
      //  $this->conn = null;
       try { 
         $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       }catch(PDOException $e) {
         echo 'Connection Error: ' . $e->getMessage();
       }
      //  var_dump($this->conn);
      return $this->conn;
     }
}
$con = new Database();
?>