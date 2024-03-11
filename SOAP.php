<?php

include("AnimalSoap.php");
$options = array('uri' => 'http://localhost/2EVAL/Ejercicios/AlejandroFresno/Protectora%20de%20Animales%20POO/');

$server = new SoapServer(NULL, $options);

$server->setClass('AnimalSoap');

$server->handle();

