<?php
class Animal extends Crud{
    private $id;
    private $idAnimal;
    private $idUsuario;
    private $fecha;
    private $raza;
    private $genero;
    private $color;
    private $edad;

    private $conn;
    private const TABLA="usuarios";
    function __construct($id,$idAnimal,$idUsuario,$fecha,$raza,$genero,$color,$edad,Conexion $conexion){
        $this->id=$id;
        $this->idAnimal=$idAnimal;
        $this->idUsuario=$idUsuario;
        $this->fecha=$fecha;
        $this->raza=$raza;
        $this->conn=$conexion->conectar();

    }
    function __get($name){
        return $this->$name;

    }

    function __set($name, $value){
        $this->$name=$value;
    }
    function crear(){} 
    function actualizar(){    $value="";
        $sql2="SELECT COLUMN_name FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
        $stmt2=$this ->conn->prepare($sql2);
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
    
        $sql="Select * from $this->tabla ";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        
        $row2=$stmt->fetchAll(PDO::FETCH_NUM);}
}