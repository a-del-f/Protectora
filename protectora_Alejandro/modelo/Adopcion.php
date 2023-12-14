<?php
require_once("crud.php");
class Adopcion extends Crud
{
    private $id;
    private $idAnimal;
    private $idUsuario;
    private $razon;
    private $fecha;
    private $conexion;

    protected const TABLA = "adopcion";

    public function __construct($conexion)
    {
        parent::__construct(Adopcion::TABLA, $conexion);
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
            $tabla = Adopcion::TABLA;
            $sql = "INSERT INTO $tabla (idAnimal, idUsuario, fecha, razon) VALUES (:idAnimal, :idUsuario, :fecha, :razon)";
            $stmt = $this->conexion->conectar()->prepare($sql);
            $stmt->bindParam(':idAnimal', $this->idAnimal);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':razon', $this->razon);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function actualizar()
    {
        try {
            $tabla = Adopcion::TABLA;
            $stmt4 = $this->conexion->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt4->bindParam(':id', $this->idUsuario);
            $stmt4->execute();
            $resultado = $stmt4->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $sql = "UPDATE $tabla SET ";
                $params = array();
                if ($this->idAnimal !== null) {
                    $sql .= "idAnimal = :idAnimal, ";
                    $params[':idAnimal'] = $this->idAnimal;
                }
                if ($this->idUsuario !== null) {
                    $sql .= "idUsuario = :idUsuario, ";
                    $params[':idUsuario'] = $this->idUsuario;
                }
                if ($this->fecha !== null) {
                    $sql .= "fecha = :fecha, ";
                    $params[':fecha'] = $this->fecha;
                }
                if ($this->razon !== null) {
                    $sql .= "razon = :razon, ";
                    $params[':razon'] = $this->razon;
                }
                if ($this->id !== null) {
                    $sql .= "id = :id, ";
                    $params[':id'] = $this->id;
                }
                if (!empty($params)) {
                    $sql = rtrim($sql, ', ');
                    $sql .= " WHERE id = :id";
                    $params[':id'] = $this->id;

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