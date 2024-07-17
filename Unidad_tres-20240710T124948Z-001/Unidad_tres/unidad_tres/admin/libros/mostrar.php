<?php
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '1234', 'sm32');

// Obtener todos los libros de la base de datos
$consulta = "SELECT * FROM libros";
$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
</head>
<body>

<h1>Lista de Libros</h1>
<table border="1">
    <thead>
    <tr>
        <th></th>
        <th>ID</th>
        <th>ISBN</th>
        <th>Nombre</th>
        <th>Autor</th>
        <th>Precio</th>
        <th>Editorial</th>
        <th>Imagen</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php while ($libro = mysqli_fetch_assoc($resultado)) : ?>
        <tr>
            <td>
                <a href="../index.php">Regresar</a>
            </td>
            <td><?php echo ($libro['id']); ?></td>
            <td><?php echo ($libro['isbn']); ?></td>
            <td><?php echo ($libro['nombre']); ?></td>
            <td><?php echo ($libro['autor']); ?></td>
            <td><?php echo ($libro['precio']); ?></td>
            <td><?php echo ($libro['editorial']); ?></td>
            <td><?php echo ($libro['imagen']); ?></td>
            <td>
                <a href="actualizar.php?id=<?php echo $libro['id']; ?>">Actualizar</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>