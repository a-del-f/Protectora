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

    function __construct($user, $servername, $dbname, $password)
    {
        $this->user = $user;
        $this->servername = $servername;
        $this->dbname = $dbname;
        $this->password = $password;
    }

    function conectar()
    {

        $conn = new PDO("mysql:host= $this->servername; dbname=$this->dbname", $this->user, $this->password);
        return $conn;
    }
}
