<?php

include("AnimalSoap.php");

$options = array('uri' => 'http://localhost/Protectora de Animales POO/');

$server = new SoapServer(NULL, $options);

$server->setClass('AnimalSoap');

$server->handle();

