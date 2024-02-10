<?php
require_once("crud.php");
class Animal extends Crud
{
    private $id;
    private $nombre;
    private $especie;
    private $raza;
    private $genero;
    private $color;
    private $edad;
    private $conexion;

    protected const TABLA = "animal";

    public function __construct($conexion)
    {
        parent::__construct(Animal::TABLA, $conexion);
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
            $tabla = Animal::TABLA;
            $sql = "INSERT INTO $tabla (nombre, especie, raza, genero, color, edad) VALUES (:nombre, :especie, :raza, :genero, :color, :edad)";
            $stmt = $this->conexion->conectar()->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':especie', $this->especie);
            $stmt->bindParam(':raza', $this->raza);
            $stmt->bindParam(':genero', $this->genero);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':edad', $this->edad);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function actualizar()
    {
        try {
            $tabla = Animal::TABLA;
            $stmt2 = $this->conexion->conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
            $stmt2->bindParam(':id', $this->id);
            $stmt2->execute();
            $resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $sql = "UPDATE $tabla SET ";
                $params = array();
                if ($this->nombre !== null) {
                    $sql .= "nombre = :nombre, ";
                    $params[':nombre'] = $this->nombre;
                }
                if ($this->especie !== null) {
                    $sql .= "especie = :especie, ";
                    $params[':especie'] = $this->especie;
                }
                if ($this->raza !== null) {
                    $sql .= "raza = :raza, ";
                    $params[':raza'] = $this->raza;
                }
                if ($this->genero !== null) {
                    $sql .= "genero = :genero, ";
                    $params[':genero'] = $this->genero;
                }
                if ($this->color !== null) {
                    $sql .= "color = :color, ";
                    $params[':color'] = $this->color;
                }
                if ($this->edad !== null) {
                    $sql .= "edad = :edad, ";
                    $params[':edad'] = $this->edad;
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