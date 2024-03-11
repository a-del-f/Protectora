<?php

if (!isset($_REQUEST['controlador'])) {
    require_once("Index_Vista.php");
} else {
    $controlador = $_REQUEST['controlador'] . "_Controlador";
    $vista = $_REQUEST['vista'] . "" . $_REQUEST["controlador"];

    $filename = $controlador . ".php";
    $queryParameters = isset($_REQUEST['controlador']) ? "?action=" . "listar" . $_REQUEST['controlador'] : '';

    header("Location: http://localhost/2EVAL/Ejercicios/AlejandroFresno/Protectora%20de%20Animales%20POO/controlador/" . $filename . $queryParameters);
}

?>