<?php
function editar (Object $valores, $array=[]){
    try{ $valores->actualizar($array);}
   catch(PDOException){
    header("index.php");
   }
}