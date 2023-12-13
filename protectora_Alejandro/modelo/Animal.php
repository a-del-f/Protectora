<?php
require_once("conexion.php");
require_once("crud.php");
class Animal extends Crud{
    private $id;
    private $nombre;
    private $especie;
    private $fecha;
    private $raza;
    private $genero;
    private $color;
    private $edad;

  
    private const TABLA="usuarios";
    function __construct($tabla,$id,$nombre,$especie,$raza,$genero,$color,$edad,Conexion $conexion){

        parent::__construct($tabla,$conexion);
        $this->id=$id;
        $this->nombre=$nombre;
        $this->especie=$especie;
        $this->raza=$raza;
        $this->genero=$genero;
        $this->color=$color;
        $this->edad=$edad;

    }
    function __get($name){
        return $this->$name;

    }

    function __set($name, $value){
        $this->$name=$value;
    }
    function crear(){
        try{
        $cone= $this->cone->conectar();
        $sql="insert into $this->tabla values(:valores)";
        $stmt=$cone->prepare($sql);
        $valor=$this->id.",".$this->nombre.",".$this->especie.",".$this->raza.",".$this->genero.",".$this->color.",".$this->edad;
        $stmt->bindParam(":valores",$valor);
        $stmt->execute();
        ?><button onclick="<?php header("location:../vista/index.php")  ?>" >Volver</button><?php

        echo "cambios realizados";}catch(PDOException){
            echo "no se han realizado los cambios"
            ?><button onclick="<?php header("location:../vista/index.php")  ?>" >Volver</button><?php
        }
    } 
    function actualizar(){    $value="";
        $sql2="SELECT COLUMN_name FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
       $cone= $this->cone->conectar();
        $stmt2=$cone->prepare($sql2);

        //introduzco variables
        $stmt2->bindParam(":tabla",$this->tabla);
        $stmt2->execute();
    
        $row=$stmt2->fetchAll(PDO::FETCH_COLUMN);
            
        $array=array_map( 'objectToArray', (array) $this );
        for($i=0;$i<count($array );$i++){
            $value=$value+$row[$i]+"="+$array[$i];
            if($i!=count($array )-1){
                $value=$value+" , ";
            }
        }
    
        $sql="Update $value from $this->tabla ";
        $stmt=$cone->prepare($sql);
        $stmt->execute();
        
        $row2=$stmt->fetchAll(PDO::FETCH_NUM);}
}