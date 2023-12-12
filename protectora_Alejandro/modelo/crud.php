<?php
require_once("conexion.php");
abstract class Crud extends Conexion
{
    private $tabla;
    private $conn;
    public function __construct($tabla,  $user, $servername, $dbname, $password,Conexion $conn)
    {
        parent::__construct($user, $servername, $dbname, $password, $conn);
        $this->tabla = $tabla;
        $this->conn=$conn;
    }
    public function obtieneTodos()
    {
        $sql="Select *from $this->tabla";
        $cone=$this->conn->conectar();
        $stmt=$cone ->query($sql);
        $r=0;
        while($row=$stmt->fetch(PDO::FETCH_NUM)){

            for($i=0;$i<count($row);$i++){
            $array[$r][$i]= $row[$i];}
            $r++;
        }
            return $array;
        }
  

  function obtieneDeId($id){
    $sql="Select *from $this->tabla";
        $cone=$this->conn->conectar();
        $array=array();
      $array=  $this->obtieneTodos();

        $sql2="SELECT COLUMN_name FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
        $stmt2=$cone->prepare($sql2);
        $stmt2->bindParam(":tabla",$this->tabla);
        $stmt2->execute();
        $i=0;
        while($row2=$stmt2->fetch(PDO::FETCH_NUM)){
            $nombre[$i]=$row2[$i];
            $i++;
     
            for($i=0;count($array);$i++){
                if($array[$i][0]==$id){
                    return $array[$i][0];
                }
            }

    }
}
function borrar($id){
    $array=array();
    $array=$this->obtieneDeId($id);
    for($r=0;$r<count($array);$r++){
            if($array[$r][0]==$id){
                $valor=$array[$r][0];
                for($d=$r;$d<count($array);$d++){
                
                    $array[$d]=$array[$d+1];
                }
                unset($array[$r]);
            }
        
    }
}

    } 
    
?>
