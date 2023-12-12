<?php
require_once("../modelo/conexion.php");
// function __construct($user, $servername, $dbname, $password)
//$conn = new PDO("mysql:host=$servername; dbname=pufosa", $username, $password);
$conexion=new Conexion("127.0.0.1",3333,"protectora_animales","root","");
$conn=$conexion->conectar();

if($_REQUEST["accion"]=="añadir"){
    
    $sql = "SELECT lower(COLUMN_name) FROM INFORMATION_SCHEMA.COLUMNS where table_name='". $name ."';";
    $stmt = $conn->query($sql);

?><div>
    <!--formulario para determinar que añadir -->
<form action="animal.php" method="post">
<?php $i=0;  while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
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
    
   
<?php }$i++; } ?>
<input type="hidden" name="longitud" id="longitud_id" value="<?php echo $i++ ?>">
<input type="hidden" name="tabla" id="tabla_id"value="<?php echo $name ?>">
<input type="submit" name="btna" id="btna_id" >

</form></div>

<?php 
try{
if (isset($_POST["btna"])) {
$valores="";
$animal="";
   for($n=0;$n<($_POST["longitud"]);$n++){
    

       

        $valores=$valores.""."'".$_POST["value".$n]."'";
        $animal=$animal.$_POST["value".$n];
        if($n!=(($_POST["longitud"])-1)){
            $valores=$valores.",";
            $animal=$animal.",";
        }
        
   }

    $sql2 = "Insert into " . $_POST["tabla"] . " values($valores)";
    $stmt = $conn->prepare($sql2);
    echo $valores;
    $stmt->execute();
}}catch(PDOException){
    //recojo error
   
}
}
if ($_REQUEST["accion"]=="ver") {
//        public function __construct($tabla,  $user, $servername, $dbname, $password)

    $conee=new Conexion("localhost",3333,"protectora_animales","root","");
   $generica= new Animal(0,0,0,0,0,0,0,0,$conee);
   $generica->obtieneTodos();
   
}
if($_REQUEST["accion"]=="editar"){
   
    $sql2 = "SELECT lower(COLUMN_name) FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(":tabla", $name);
    $stmt2->execute();
   ?><div>
    <!--formulario para determinar que añadir -->
    
<form action="animal.php" method="post">
<label >Indica la id del animal que desees modificar</label>
<input type="text" name="localizador" id="localizador_id">
<?php $i=0;  while ($row = $stmt2->fetch(PDO::FETCH_COLUMN)) {
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
    
   
<?php }$i++; } ?>
<input type="hidden" name="longitud" id="longitud_id" value="<?php echo $i++ ?>">
<input type="hidden" name="tabla" id="tabla_id"value="<?php echo $name ?>">
<input type="submit" name="btne" id="btne_id" >


</form></div> <?php 

    try{
        if (isset($_POST["btna"])) {
        $valores="";
        $animal="";
           for($n=0;$n<($_POST["longitud"]);$n++){
            
        
               
        
                $valores=$valores.""."'".$_POST["value".$n]."'";
                $atributos=$animal.$_POST["value".$n];
                if($n!=(($_POST["longitud"])-1)){
                    $valores=$valores.",";
                    $animal=$animal.",";
                }
                
           }
           
           $array=explode(",",$atributos);
           echo count($array);
        //   $animal=new Animal($array);


}}catch(PDOException $e){
    //recojo error
   
}}
?>