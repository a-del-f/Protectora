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
    <title>Gestion de Usuarios</title>
</head>

<body>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'listarusuario'): ?>
        <button onclick="goToIndex()">TABLAS</button>
        <h1>Gestion de Usuarios</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sexo</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
            <?php foreach ($Usuarios as $usuario): ?>
                <tr>
                    <td>
                        <?php echo $usuario->id; ?>
                    </td>
                    <td>
                        <?php echo $usuario->nombre; ?>
                    </td>
                    <td>
                        <?php echo $usuario->apellido; ?>
                    </td>
                    <td>
                        <?php echo $usuario->sexo; ?>
                    </td>
                    <td>
                        <?php echo $usuario->direccion; ?>
                    </td>
                    <td>
                        <?php echo $usuario->telefono; ?>
                    </td>
                    <td>
                        <a
                            href="../controlador/Usuario_Controlador.php?action=editarusuario&id=<?php echo $usuario->id; ?>">Editar</a>
                    </td>
                    <td>
                        <a
                            href="../controlador/Usuario_Controlador.php?action=borrarusuario&id=<?php echo $usuario->id; ?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="../controlador/Usuario_Controlador.php?action=crearusuario">Agregar nuevo Usuario</a>
    <?php endif; ?>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'crearusuario'): ?>
        <button onclick="goBack()">VOLVER</button>
        <h1>Creador usuarios</h1>
        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" required><br>

            <label for="sexo">Sexo:</label>
            <input type="text" name="sexo" required><br>

            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion" required><br>

            <label for="telefono">Telefono:</label>
            <input type="phone" name="telefono" required><br>

            <input type="submit" value="Crear Usuario">
        </form>
    <?php endif; ?>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'editarusuario'): ?>
        <button onclick="goBack()">VOLVER</button>
        <h1>Editor de usuarios</h1>
        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $Usuario->nombre ?>" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" value="<?php echo $Usuario->apellido ?>" required><br>

            <label for="sexo">Sexo:</label>
            <input type="text" name="sexo" value="<?php echo $Usuario->sexo ?>" required><br>

            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion" value="<?php echo $Usuario->direccion ?>" required><br>

            <label for="telefono">Telefono:</label>
            <input type="phone" name="telefono" value="<?php echo $Usuario->telefono ?>" required><br>

            <input type="submit" value="Editar Usuario">
        </form>
    <?php endif; ?>
</body>

</html>