<?php

/**
 *    $servername="localhost:3333";
 *$username="root";
 *$password="";

 *$conn = new PDO("mysql:host=$servername; dbname=pufosa", $username, $password);
 *$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 */
class Conexion
{
    private $user;
    private $servername;
    private $dbname;
    private $password;
    private $port;


    function __construct( $servername,$port, $dbname,$user, $password)
    {
        $this->user = $user;
        $this->servername = $servername;
        $this->dbname = $dbname;
        $this->port=$port;
        $this->password = $password;
    }

    function conectar()
    {
        $dsn = "mysql:host={$this->servername};port={$this->port};dbname={$this->dbname};charset=utf8";
            $conn= new PDO($dsn, $this->user, $this->password);
        return $conn;
    }
}
