<?php
require_once("crud.php");
class Usuario extends Crud
{
    private $id;
    private $nombre;
    private $apellido;
    private $sexo;
    private $direccion;
    private $telefono;
    private $conexion;

    protected const TABLA = "usuarios";

    public function __construct($conexion)
    {
        parent::__construct(Usuario::TABLA, $conexion);
        $this->conexion = $conexion;
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    public function crear()
    {
        try {
            $tabla = Usuario::TABLA;
            $sql = "INSERT INTO $tabla (nombre, apellido, sexo, direccion, telefono) VALUES (:nombre, :apellido, :sexo, :direccion, :telefono)";
            $stmt = $this->conexion->conectar()->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido', $this->apellido);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':direccion', $this->direccion);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function actualizar()
    {
        try {
            $tabla = Usuario::TABLA;
            $stmt2 = $this->conexion->conectar()->prepare("SELECT id FROM $tabla WHERE nombre = :nombre AND apellido = :apellido");
            $stmt2->bindParam(':nombre', $this->nombre);
            $stmt2->bindParam(':apellido', $this->apellido);
            $stmt2->execute();
            $resultado = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $sql = "UPDATE $tabla SET ";
                $params = array();
                if ($this->nombre !== null) {
                    $sql .= "nombre = :nombre, ";
                    $params[':nombre'] = $this->nombre;
                }
                if ($this->apellido !== null) {
                    $sql .= "apellido = :apellido, ";
                    $params[':apellido'] = $this->apellido;
                }
                if ($this->sexo !== null) {
                    $sql .= "sexo = :sexo, ";
                    $params[':sexo'] = $this->sexo;
                }
                if ($this->direccion !== null) {
                    $sql .= "direccion = :direccion, ";
                    $params[':direccion'] = $this->direccion;
                }
                if ($this->telefono !== null) {
                    $sql .= "telefono = :telefono, ";
                    $params[':telefono'] = $this->telefono;
                }
                if (!empty($params)) {
                    $sql = rtrim($sql, ', ');
                    $sql .= " WHERE id = :id";
                    $params[':id'] = $resultado['id'];

                    $stmt = $this->conexion->conectar()->prepare($sql);
                    $stmt->execute($params);

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

} ?>