<?php
class Database
{
    private $dbServer = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbName = 'pathshala';
    protected $conn;

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->dbServer}; dbname={$this->dbName}; charset=utf8";
            $options = array(PDO::ATTR_PERSISTENT);
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

    }
}

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "pathshala";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}



$con = mysqli_connect("localhost","root","","pathshala");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}



?>