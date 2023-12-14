<?php
class Conexion
{
    private $servidor;
    private $puerto;
    private $db;
    private $usuario;
    private $password;
    private $pdo;

    public function __construct($servidor, $puerto, $db, $usuario, $password)
    {
        $this->servidor = $servidor;
        $this->puerto = $puerto;
        $this->db = $db;
        $this->usuario = $usuario;
        $this->password = $password;
    }

    public function conectar()
    {
        try {
            $dsn = "mysql:host={$this->servidor};port={$this->puerto};dbname={$this->db};charset=utf8";
            $this->pdo = new PDO($dsn, $this->usuario, $this->password);
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
?>