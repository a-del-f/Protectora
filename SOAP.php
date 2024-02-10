<?php

include("AnimalSoap.php");

$options = array('uri' => 'http://localhost/aa/SOAP/prueba/');

$server = new SoapServer(NULL, $options);

$server->setClass('AnimalSoap');

$server->handle();

