<?php
require_once("../modelo/conexion.php");
$conexion=new Conexion("127.0.0.1",3333,"protectora_animales","root","");
$conn=$conexion->conectar();
session_start();

if($_SESSION["accion"]=="editar"){
    $sql2 = "SELECT lower(COLUMN_name) FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(":tabla", $name);
    $stmt2->execute();
    session_start(); ?><form action=""><?
   $i=0;  while ($row = $stmt2->fetch(PDO::FETCH_COLUMN)) {
        $array[$i] = $row;
    ?>
   
    <label ><?php echo "Introduce " . $row; ?></label>
    
    <?php
            $control= strpos($row, 'id');
      if( $control===false) 
    { ?>
                   <input type="text" name="<?php echo "value" . "$i" ?>" id="<?php echo "$row" . "_id" ?>">
                   <br>
    <?php } else if($control!==false) {
            if($i==0){
                ?>
                        <input type="numeric" name="<?php echo "value" . "$i" ?>" id="<?php echo "texto" . "_id"  ?>">
                        <br>
                <?php
    
            }
    
             
             
                ?><br> 
        
       
    <?php }$i++; } ?> </form> <?php
}

if($_SESSION["accion"]="ver"){
    $conee=new Conexion("localhost",3333,"protectora_animales","root","");
    $generica= new Animal(0,0,0,0,0,0,0,0,$conee);
    $generica->obtieneTodos();
}
if($_SESSION["accion"]="añadir")
?>