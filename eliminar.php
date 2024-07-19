<?php
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '1234', 'sm32');

// Comprobar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Si se recibe una solicitud de eliminación, se procesa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id'];

    $peticionEliminar = "DELETE FROM libros WHERE id='$id'";

    if (mysqli_query($conexion, $peticionEliminar)) {
        header("Location: ../index.php");  // Redirige a la lista de libros.
        exit();
    } else {
        echo "Error al eliminar el libro: " . mysqli_error($conexion);
    }
}

// Obtener los registros de la base de datos
$peticionSeleccionar = "SELECT * FROM libros";
$resultado = mysqli_query($conexion, $peticionSeleccionar);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar un libro</title>
</head>

<body>
<a href="../index.php">Atras</a>
<h1>Lista de Libros</h1>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>ISBN</th>
        <th>Nombre</th>
        <th>Autor</th>
        <th>Precio</th>
        <th>Editorial</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($libro = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td><?php echo $libro['id']; ?></td>
            <td><?php echo $libro['isbn']; ?></td>
            <td><?php echo $libro['nombre']; ?></td>
            <td><?php echo $libro['autor']; ?></td>
            <td><?php echo $libro['precio']; ?></td>
            <td><?php echo $libro['editorial']; ?></td>
            <td><?php echo $libro['imagen']; ?></td>
            <td>
                <form action="eliminar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>