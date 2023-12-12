<?php 
class Adopcion extends Crud{
    private $id;
    private $idAnimal;
    private $idUsuario;
    private $fecha;
    private $razón;
    private $conexion;
    const Tabla="adopcion";
    public function __construct($id,$idAnimal,$idUsuario,$fecha,$razón,$conexion) {
    }
}