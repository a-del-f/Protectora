<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once("../modelo/conexion.php");
require_once("../modelo/Animal.php");
require_once("../modelo/crud.php");
$conexion = new Conexion("127.0.0.1", 3333, "protectora_animales", "root", "");
$conn = $conexion->conectar();
session_start();

if ($_SESSION["accion"] == "editar") {
    $sql2 = "SELECT lower(COLUMN_name) FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(":tabla", $name);
    $stmt2->execute();
    session_start();
    ?>
    <form action="">
        <?php
        $i = 0;
        while ($row = $stmt2->fetch(PDO::FETCH_COLUMN)) {
            $array[$i] = $row;
        ?>
            <label><?php echo "Introduce " . $row; ?></label>

            <?php
            $control = strpos($row, 'id');
            if ($control === false) { ?>
                <input type="text" name="<?php echo "value" . "$i" ?>" id="<?php echo "$row" . "_id" ?>">
                <br>
            <?php } else if ($control !== false) {
                if ($i == 0) { ?>
                    <input type="numeric" name="<?php echo "value" . "$i" ?>" id="<?php echo "texto" . "_id"  ?>">
                    <br>
            <?php }

            ?><br>
<?php }
            $i++;
        } ?>
    </form>
<?php }

if ($_SESSION["accion"] == "ver") {
    $conee = new Conexion("localhost", 3333, "protectora_animales", "root", "");


    $generica = new Animal("animal", null, null, null, null, null, null,null,  $conee);
   $array= $generica->obtieneTodos();
   ?> <table border="1"> <?php
   for($i=0;$i<count($array);$i++){
     ?> <tr> <?php
    for($r=0;$r<count($array[$i]);$r++){
            ?> <td> <?php echo $array[$i][$r] ;?></td> <?php
    }
    ?> </tr> <?php
   }
   ?> </table> <?php
}
if ($_SESSION["accion"] == "añadir") {
?>
<form action="animal_controlador.php">
<?php
    $i=0;  while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
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
        
       
    <?php }$i++; }?> 
    <input type="submit" name="btnaa" id="">
    </form><?php
}
?>
</body>
</html>
