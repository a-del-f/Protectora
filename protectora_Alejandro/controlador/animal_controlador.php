<?php
require_once("../core/conexion.php");
require_once("../modelo/animal.php");

class AnimalController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function listarAnimales()
    {
        $animal = new Animal($this->conexion);
        $animales = $animal->obtenerTodos();
        if ($animales) {
            include("../vista/Animal_vista.php");
        } else {
            echo "No se encontraron animales.";
        }
    }

    public function crearAnimal()
    {
        $a = new Animal($this->conexion);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a->nombre = $_POST["nombre"];
            $a->especie = $_POST["especie"];
            $a->raza = $_POST["raza"];
            $a->genero = $_POST["genero"];
            $a->color = $_POST["color"];
            $a->edad = $_POST["edad"];
            if ($a->crear()) {
                header("Location: http://localhost/Protectora%20de%20animales%20POO/controlador/Animal_Controlador.php?action=listarAnimal");
            }
        } else {
            include("../vista/Animal_vista.php");
        }
    }

    public function editarAnimal($id)
    {
        $a = new Animal($this->conexion);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a->id = $_POST["id"];
            $a->nombre = $_POST["nombre"];
            $a->especie = $_POST["especie"];
            $a->raza = $_POST["raza"];
            $a->genero = $_POST["genero"];
            $a->color = $_POST["color"];
            $a->edad = $_POST["edad"];
            if ($a->actualizar()) {
                header("Location: http://localhost/Protectora%20de%20animales%20POO/controlador/Animal_Controlador.php?action=listarAnimal");
            } else {
                echo "error";
            }
        } else {
            $animal = $a->obtenerDeID($id);
            include("../vista/Animal_vista.php");
        }


    }

    public function borrarAnimal($id)
    {
        $a = new Animal($this->conexion);
        if ($a->borrar($id)) {
            header("Location: http://localhost/Protectora%20de%20animales%20POO/controlador/Animal_Controlador.php?action=listarAnimal");
        } else {
            echo "error";
        }
    }

}

$conexion = new Conexion("localhost", 3307, "protectora_animales", "root", "");
$controller = new AnimalController($conexion);

$action = isset($_GET['action']) ? $_GET['action'] : 'listarAnimal';

switch ($action) {
    case 'listarAnimal':
        $controller->listarAnimales();
        break;
    case 'crearAnimal':
        $controller->crearAnimal();
        break;
    case 'editarAnimal':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->editarAnimal($id);
        break;
    case 'borrarAnimal':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->borrarAnimal($id);
        break;
}
?>