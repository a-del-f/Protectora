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
    <title>Gestion de Adopciones</title>
</head>

<body>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'listaradopcion'): ?>
        <button onclick="goToIndex()">TABLAS</button>
        <h1>Gestion de Adopciones</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>ID Animal</th>
                <th>ID Usuario</th>
                <th>Fecha</th>
                <th>Razon</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
            <?php foreach ($Adopciones as $Adopcion): ?>
                <tr>
                    <td>
                        <?php echo $Adopcion->id; ?>
                    </td>
                    <td>
                        <?php echo $Adopcion->idAnimal; ?>
                    </td>
                    <td>
                        <?php echo $Adopcion->idUsuario; ?>
                    </td>
                    <td>
                        <?php echo $Adopcion->fecha; ?>
                    </td>
                    <td>
                        <?php echo $Adopcion->razon; ?>
                    </td>
                    <td>
                        <a
                            href="../controlador/Adopcion_Controlador.php?action=editarAdopcion&id=<?php echo $Adopcion->id; ?>">Editar</a>
                    </td>
                    <td>
                        <a
                            href="../controlador/Adopcion_Controlador.php?action=borrarAdopcion&id=<?php echo $Adopcion->id; ?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="../controlador/Adopcion_Controlador.php?action=crearAdopcion">Agregar nuevo Adopcion</a>
    <?php endif; ?>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'crearAdopcion'): ?>
        <button onclick="goBack()">VOLVER</button>
        <h1>Creador Adopciones</h1>
        <form method="post" action="">
            <label for="idAnimal">ID Animal:</label>
            <select name="idAnimal" required>
                <?php foreach ($Animales as $ani): ?>
                    <option value="<?php echo $ani->id; ?>">
                        <?php echo $ani->id . " : " . $ani->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="idUsuario">ID Usuario:</label>
            <select name="idUsuario" required>
                <?php foreach ($Usuarios as $usu): ?>
                    <option value="<?php echo $usu->id; ?>">
                        <?php echo $usu->id . " : " . $usu->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required><br>

            <label for="razon">Razon:</label>
            <input type="text" name="razon" required><br>
            <br>

            <input type="submit" value="Crear Adopcion">
        </form>
    <?php endif; ?>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'editarAdopcion'): ?>
        <button onclick="goBack()">VOLVER</button>
        <h1>Editor de Adopciones</h1>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $Adopcion->id ?>" required><br>

            <label for="idAnimal">ID Animal:</label>
            <select name="idAnimal" required>
                <?php foreach ($Animales as $ani): ?>
                    <option value="<?php echo $ani->id; ?>" <?php echo ($ani->id == $Adopcion->idAnimal) ? 'selected' : ''; ?>>
                        <?php echo $ani->id . " : " . $ani->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="idUsuario">ID Usuario:</label>
            <select name="idUsuario" required>
                <?php foreach ($Usuarios as $usu): ?>
                    <option value="<?php echo $usu->id; ?>" <?php echo ($usu->id == $Adopcion->idUsuario) ? 'selected' : ''; ?>>
                        <?php echo $usu->id . " : " . $usu->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" value="<?php echo $Adopcion->fecha ?>" required><br>

            <label for="razon">Razon:</label>
            <input type="text" name="razon" value="<?php echo $Adopcion->razon ?>" required><br>

            <input type="submit" value="Editar Adopcion">
        </form>
    <?php endif; ?>
</body>

</html>