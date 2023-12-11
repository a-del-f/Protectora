



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

if(isset($i)){
    

 

    

        if($_POST["accion"]="ver"){
        header("location:ver.php");}
        if($_POST["accion"]="añadir"){
        header("location:añadir.php");}
        if($_POST["accion"]="editar"){
        header("location:editar.php");}


    
}
?>
<!--$id,$nombre,$apellido,$sexo,$direccion,$telefono,$edad-->
    <form action="vista_usuario.php" method="post">
        <select name="tipo" id="tipo_id">
            <option value="usuario">Usario</option>
            <option value="animal">Animal</option>
        </select>

        <input type="radio" name="accion" id="acccion_id" value="ver">
        <label>ver</label>
        <input type="radio" name="accion" id="accion_id" value="añadir">
        <label>añadir</label>
        <input type="radio" name="accion" id="accion" value="editar">
        <label>editar</label>

    </form>
</body>
</html>
