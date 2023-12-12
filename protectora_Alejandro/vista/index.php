



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

if(isset($_POST["btn"])){
    

 

    

        if($_POST["tipo"]=="usuario"){
        header("location:usuario_vista.php");}
        if($_POST["tipo"]=="animal"){
        header("location:animal_vista.php");}
        if($_POST["tipo"]=="adopcion"){
        header("location:adopcion_vista.php");}


    
}
?>
<!--$id,$nombre,$apellido,$sexo,$direccion,$telefono,$edad-->
    <form action="index.php" method="post">
        <select name="tipo" id="tipo_id">
            <option value="usuario">Usario</option>
            <option value="animal">Animal</option>
            <option value="adopcion">Adopción</option>
        </select>

        <input type="radio" name="accion" id="acccion_id" value="ver">
        <label>ver</label>
        <input type="radio" name="accion" id="accion_id" value="añadir">
        <label>añadir</label>
        <input type="radio" name="accion" id="accion" value="editar">
        <label>editar</label>
        <input type="submit" name="btn" id="btn_id" >

    </form>
</body>
</html>
