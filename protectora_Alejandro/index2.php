<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
</head>

<body>
    <form action="#" method="post">
        <label for="fecha">Selecciona una fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <input type="submit" name="envio">
    </form>

</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén la fecha tal como se envió
    $fechaEnviada = $_POST["fecha"];

    // Convierte la fecha al formato deseado (YYYY/MM/DD)
    $fechaFormateada = date("Y/m/d", strtotime($fechaEnviada));

    // Puedes hacer lo que necesites con la fecha formateada
    echo "Fecha formateada: " . $fechaFormateada;
}