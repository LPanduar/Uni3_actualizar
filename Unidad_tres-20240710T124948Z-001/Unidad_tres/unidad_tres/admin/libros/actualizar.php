<?php

session_start();

// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '1234', 'sm32');

// Control de errores.
$errores = [];

// Se declaran las variables de forma global con un valor vacío.
$id = '';
$isbn = '';
$nombre = '';
$autor ='';
$precio ='';
$editorial ='';
$imagen = '';

// Toma el valor de lo que fue ingresado en el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $isbn = $_POST['isbn'];
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $editorial = $_POST['editorial'];
    $imagen = $_POST['imagen'];

    // Evalua si la variable está vacía, y en el caso de que lo esté, el array suma un error.
    if ($isbn === '') {
        $errores[] = 'Debes ingresar un ISBN';
    }

    if ($nombre === '') {
        $errores[] = 'Debes ingresar un Nombre';
    }
    if ($autor === '') {
        $errores[] = 'Debes ingresar un Autor';
    }
    if ($precio === '') {
        $errores[] = 'Debes ingresar un Precio';
    }
    if ($editorial === '') {
        $errores[] = 'Debes ingresar una Editorial';
    }
    if ($imagen === '') {
        $errores[] = 'Debes ingresar una Imagen';
    }

    // Si no hay errores, se actualiza el registro en la base de datos.
    if (empty($errores)) {
        $peticionActualizar = "UPDATE libros SET isbn='$isbn', nombre='$nombre', autor='$autor', precio='$precio', editorial='$editorial', imagen='$imagen' WHERE id='$id'";

        if (mysqli_query($conexion, $peticionActualizar)) {
            header("Location: mostrar.php");  // Redirige a la lista de libros.
            exit();
        } else {
            header("Location: mensaje_error.php"); // Si hay errores, redirige a la página de mensaje de errores.
            exit();
        }
    } else {
        header("Location: mensaje_error.php"); // Si los valores no se pueden actualizar, también redirige a mensaje_error.
        exit();
    }
} elseif (isset($_GET['id'])) {
    // Si se proporciona un ID en la URL, se recuperan los datos del libro.
    $id = $_GET['id'];
    $peticionSeleccionar = "SELECT * FROM libros WHERE id='$id'";
    $resultado = mysqli_query($conexion, $peticionSeleccionar);
    $libro = mysqli_fetch_assoc($resultado);

    if ($libro) {
        $isbn = $libro['isbn'];
        $nombre = $libro['nombre'];
        $autor = $libro['autor'];
        $precio = $libro['precio'];
        $editorial = $libro['editorial'];
        $imagen = $libro['imagen'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar un libro</title>
</head>

<body>
<a href="mostrar.php">Regresar</a>

<form action="actualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <label for="">ISBN</label>
    <input type="text" name="isbn" value="<?php echo($isbn); ?>">
    <label for="">Nombre</label>
    <input type="text" name="nombre" value="<?php echo($nombre); ?>">
    <label for="">Autor</label>
    <input type="text" name="autor" value="<?php echo($autor); ?>">
    <label for="">Precio</label>
    <input type="number" name="precio" value="<?php echo($precio); ?>">
    <label for="">Editorial</label>
    <input type="text" name="editorial" value="<?php echo($editorial); ?>">
    <label for="">Imagen</label>
    <input type="text" name="imagen" value="<?php echo($imagen); ?>">
    <input type="submit" value="Actualizar">
</form>
</body>

</html>