
<?php
Class Usuario extends Crud{

private $id;
private $nombre;
private $apellido;
private $sexo;
private $direccion;
 private $telefono;
 private $edad ;
 private $conexion;
/*
function  __construct($id,$nombre,$apellido,$sexo,$direccion,$telefono,$edad,$conexion,$tabla, $user, $servername, $dbname, $password){
    parent::__construct($tabla, $user, $servername, $dbname, $password);
    $this->id=$id;
    $this->nombre=$nombre;
    $this->apellido->$apellido;
    $this->sexo=$sexo;
    $this->direccion= $direccion;
    $this->telefono=$telefono;
    $this->edad=$edad;
    $this->conexion = $this->conectar();

}*/

function  __construct($id,$nombre,$apellido,$sexo,$direccion,$telefono,$edad,Conexion $conn){
    $this->id=$id;
    $this->nombre=$nombre;
    $this->apellido->$apellido;
    $this->sexo=$sexo;
    $this->direccion= $direccion;
    $this->telefono=$telefono;
    $this->edad=$edad;
    $this->conexion = $conn->conectar();

}
function __set($name,$valor){
$this->$name=$valor;
}  
function __get($name){
return $this->$name;
}

function crear($array=[]){

}
function actualizar($id){
    $value="";
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

    $sql="Update $value from $this->tabla where :id ";
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(":id",$row[0]=$id);
    $stmt->execute();
    
    $row2=$stmt->fetchAll(PDO::FETCH_NUM);
    
}
}

