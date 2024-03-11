<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <script>
        function goBack() {
            window.history.back();
        }

        function goToIndex() {
            window.location.href = '../index.php';
        }
    </script>
    <title>Gestion de Animales</title>
</head>

<body>
<?php

$options=array('uri'=>'http://localhost/2EVAL/Ejercicios/AlejandroFresno/Protectora%20de%20Animales%20POO/',
    'location'=>'http://localhost/2EVAL/Ejercicios/AlejandroFresno/Protectora%20de%20Animales%20POO/SOAP.php');

if(isset($_POST["buscar"])  ) {
    try {
        $client = new SoapClient(null, $options);
        $response = $client->check($_POST["buscarID"]);

        switch ($response){
            case 0:
                echo "<script> alert('La id introducida no pertenece a ningun animal') </script>";
                break;
            case 1:
                echo "<script> alert('La id introducida pertenece a un animal pero no ha sido adoptado') </script>";
                break;
            case 2:
                echo "<script> alert('La id introducida pertenece a un animal que ha sido adoptado') </script>";
                break;


        }

    }catch (SoapFault $e) {
        echo "ERROR: " . $e->getMessage();
    }}

if (isset($_GET['action']) && $_GET['action'] == 'listarAnimal'): ?>
    <button onclick="goToIndex()">TABLAS</button>
    <h1>Gestion de Animales</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Raza</th>
            <th>Género</th>
            <th>Color</th>
            <th>Edad</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($animales as $animal): ?>
            <tr>
                <td>
                    <?php echo $animal->id; ?>
                </td>
                <td>
                    <?php echo $animal->nombre; ?>
                </td>
                <td>
                    <?php echo $animal->especie; ?>
                </td>
                <td>
                    <?php echo $animal->raza; ?>
                </td>
                <td>
                    <?php echo $animal->genero; ?>
                </td>
                <td>
                    <?php echo $animal->color; ?>
                </td>
                <td>
                    <?php echo $animal->edad; ?>
                </td>
                <td>
                    <a
                            href="../controlador/Animal_Controlador.php?action=editarAnimal&id=<?php echo $animal->id; ?>">Editar</a>
                </td>
                <td>
                    <a
                            href="../controlador/Animal_Controlador.php?action=borrarAnimal&id=<?php echo $animal->id; ?>">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../controlador/Animal_Controlador.php?action=crearAnimal">Agregar nuevo animal</a>

    <form method="post">
        <label>Comprueba que animal ha sido adoptado a partir de la id </label>
        <input type="number" name="buscarID">
        <input type="submit" name="buscar">
    </form>
<?php endif; ?>
<?php if (isset($_GET['action']) && $_GET['action'] == 'crearAnimal'): ?>
    <button onclick="goBack()">VOLVER</button>
    <h1>Creador Animales</h1>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="especie">Especie:</label>
        <input type="text" name="especie" required><br>

        <label for="raza">Raza:</label>
        <input type="text" name="raza" required><br>

        <label for="genero">Género:</label>
        <select name="genero" required>
            <option value="Hembra">Hembra</option>
            <option value="Macho">Macho</option>
        </select><br>

        <label for="color">Color:</label>
        <input type="text" name="color" required><br>

        <label for="edad">Edad:</label>
        <input min="0" type="number" name="edad" required><br>

        <input type="submit" value="Crear Animal">
    </form>
<?php endif; ?>
<?php if (isset($_GET['action']) && $_GET['action'] == 'editarAnimal'): ?>
    <button onclick="goBack()">VOLVER</button>
    <h1>Editor de Animales</h1>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $animal->id ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $animal->nombre ?>" required><br>

        <label for="especie">Especie:</label>
        <input type="text" name="especie" value="<?php echo $animal->especie ?>" required><br>

        <label for="raza">Raza:</label>
        <input type="text" name="raza" value="<?php echo $animal->raza ?>" required><br>

        <label for="genero">Género:</label>
        <select name="genero" required>
            <option value="Hembra" <?php echo ($animal->genero == 'Hembra') ? 'selected' : ''; ?>>Hembra</option>
            <option value="Macho" <?php echo ($animal->genero == 'Macho') ? 'selected' : ''; ?>>Macho</option>
        </select><br>


        <label for="color">Color:</label>
        <input type="text" name="color" value="<?php echo $animal->color ?>" required><br>

        <label for="edad">Edad:</label>
        <input min="0" type="number" name="edad" value="<?php echo $animal->edad ?>" required><br>

        <input type="submit" value="Editar Animal">
    </form>
<?php endif; ?>
</body>

</html>