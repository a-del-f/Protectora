<?php

require_once '../core/Conexion.php';
abstract class Crud extends Conexion
{
    protected $tabla;
    private $conexion;

    public function __construct($tabla, $conexion)
    {
        $this->tabla = $tabla;
        $this->conexion = $conexion;
    }

    public function obtenerTodos()
    {
        $stmt = $this->conexion->conectar()->prepare("SELECT * FROM $this->tabla");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objetos = array();
        foreach ($resultados as $fila) {
            if ($this->tabla === "usuarios") {
                $nombreClase = "Usuario";
            } else {
                $nombreClase = ucfirst($this->tabla);
            }
            $objeto = new $nombreClase($this->tabla, $this->conexion);
            foreach ($fila as $columna => $valor) {
                $objeto->{$columna} = $valor;
            }
            $objetos[] = $objeto;
        }
        return $objetos;
    }


    public function obtenerDeID($id)
    {
        $stmt = $this->conexion->conectar()->prepare("SELECT * FROM $this->tabla WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            if ($this->tabla === "usuarios") {
                $nombreClase = "Usuario";
            } else {
                $nombreClase = ucfirst($this->tabla);
            }
            $objeto = new $nombreClase($this->tabla, $this->conexion);
            foreach ($fila as $columna => $valor) {
                $objeto->{$columna} = $valor;
            }

            return $objeto;
        } else {
            return null;
        }
    }


    public function borrar($id)
    {
        $stmt2 = $this->conexion->conectar()->prepare("SELECT * FROM $this->tabla WHERE id = :id");
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();
        if ($stmt2->rowCount() > 0) {
            $stmt = $this->conexion->conectar()->prepare("DELETE FROM $this->tabla WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } else {
            return false;
        }


    }

    abstract public function crear();
    abstract public function actualizar();
}
?>