<?php
require_once("../core/conexion.php");
require_once("../modelo/adopcion.php");
require_once("../modelo/usuario.php");
require_once("../modelo/animal.php");

class AdopcionController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function listarAdopciones()
    {
        $adopcion = new Adopcion($this->conexion);
        $Adopciones = $adopcion->obtenerTodos();
        if ($Adopciones) {
            include("../vista/adopcion_vista.php");
        } else {
            echo "No se encontraron adopciones.";
        }
    }

    public function crearadopcion()
    {
        $a = new adopcion($this->conexion);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a->idAnimal = $_POST["idAnimal"];
            $a->idUsuario = $_POST["idUsuario"];
            $a->fecha = date("Y/m/d", strtotime($_POST["fecha"]));
            $a->razon = $_POST["razon"];
            if ($a->crear()) {
                header("Location: http://localhost/Protectora%20de%20Animales%20POO/controlador/adopcion_Controlador.php?action=listaradopcion");
            }
        } else {
            include("../vista/Adopcion_Vista.php");
        }
    }

    public function editaradopcion($id)
    {
        $a = new adopcion($this->conexion);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a->id = $_POST["id"];
            $a->idAnimal = $_POST["idAnimal"];
            $a->idUsuario = $_POST["idUsuario"];
            $a->fecha = date("Y/m/d", strtotime($_POST["fecha"]));
            $a->razon = $_POST["razon"];
            if ($a->actualizar()) {
                header("Location: http://localhost/Protectora%20de%20Animales%20POO/controlador/adopcion_Controlador.php?action=listaradopcion");
            } else {
                echo "error";
            }
        } else {
            $Adopcion = $a->obtenerDeID($id);
            $an = new Animal($this->conexion);
            $Animales = $an->obtenerTodos();
            $u = new Usuario($this->conexion);
            $Usuarios = $u->obtenerTodos();
            include("../vista/Adopcion_Vista.php");
        }


    }

    public function borraradopcion($id)
    {
        $a = new adopcion($this->conexion);
        if ($a->borrar($id)) {
            header("Location: http://localhost/Protectora%20de%20Animales%20POO/controlador/adopcion_Controlador.php?action=listaradopcion");
        } else {
            echo "error";
        }
    }

}

$conexion = new Conexion("localhost", 3307, "protectora_animales", "root", "");
$controller = new adopcionController($conexion);

$action = isset($_GET['action']) ? $_GET['action'] : 'listaradopcion';

switch ($action) {
    case 'listaradopcion':
        $controller->listarAdopciones();
        break;
    case 'crearAdopcion':
        $controller->crearadopcion();
        break;
    case 'editarAdopcion':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->editaradopcion($id);
        break;
    case 'borrarAdopcion':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->borraradopcion($id);
        break;
}
?>