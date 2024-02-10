<?php
require_once("../core/conexion.php");
require_once("../modelo/usuario.php");

class UsuarioController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function listarusuarioes()
    {
        $usuario = new Usuario($this->conexion);
        $Usuarios = $usuario->obtenerTodos();
        if ($Usuarios) {
            include("../vista/Usuario_vista.php");
        } else {
            echo "No se encontraron usuarioes.";
        }
    }

    public function crearusuario()
    {
        $a = new Usuario($this->conexion);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a->nombre = $_POST["nombre"];
            $a->apellido = $_POST["apellido"];
            $a->sexo = $_POST["sexo"];
            $a->direccion = $_POST["direccion"];
            $a->telefono = $_POST["telefono"];
            if ($a->crear()) {
                header("Location: http://localhost/Protectora%20de%20animales%20POO/controlador/Usuario_Controlador.php?action=listarusuario");
            }
        } else {
            include("../vista/Usuario_vista.php");
        }
    }

    public function editarusuario($id)
    {
        $a = new Usuario($this->conexion);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a->id = $_POST["id"];
            $a->nombre = $_POST["nombre"];
            $a->apellido = $_POST["apellido"];
            $a->sexo = $_POST["sexo"];
            $a->direccion = $_POST["direccion"];
            $a->telefono = $_POST["telefono"];
            if ($a->actualizar()) {
                header("Location: http://localhost/Protectora%20de%20animales%20POO/controlador/Usuario_Controlador.php?action=listarusuario");
            } else {
                echo "error";
            }
        } else {
            $Usuario = $a->obtenerDeID($id);
            include("../vista/Usuario_vista.php");
        }


    }

    public function borrarusuario($id)
    {
        $a = new Usuario($this->conexion);
        if ($a->borrar($id)) {
            header("Location: http://localhost/Protectora%20de%20animales%20POO/controlador/Usuario_Controlador.php?action=listarusuario");
        } else {
            echo "error";
        }
    }

}

$conexion = new Conexion("localhost", 3333, "protectora_animales", "root", "");
$controller = new usuarioController($conexion);

$action = isset($_GET['action']) ? $_GET['action'] : 'listarusuario';

switch ($action) {
    case 'listarusuario':
        $controller->listarusuarioes();
        break;
    case 'crearusuario':
        $controller->crearusuario();
        break;
    case 'editarusuario':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->editarusuario($id);
        break;
    case 'borrarusuario':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->borrarusuario($id);
        break;
}
?>