<?php
function añadir (Object $valores, $array=[]){
    try{ $valores->crear($array);}
   catch(PDOException){
    header("index.php");
   }
}
?>