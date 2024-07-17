<?php

session_start();

// Esta la conexion a la base de datos -- Su nombre es libreria2
$conexion = mysqli_connect('localhost', 'root', '1234', 'sm32');

// Control de errores.

$errores = [];


// Se declaran las variables de forma global con un valor vacío. para evitar el error de variable indefinida.
// Asi como poder evaluar si esta vacía o no, con un condicional, para ofrecer una respuesta.
$isbn = '';
$nombre = '';
$autor ='';
$precio ='';
$editorial ='';
$imagen = '';


// Toma el valor de lo que fue ingresado en el formulario  ---> $_POST ['name en el input'], para llenar las variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $editorial = $_POST['editorial'];
    $imagen = $_POST['imagen'];


// Evalua si la variable esta vacia, y en el caso de que lo este, el array suma un error (cada string al que se le iguala).
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
        $errores[] = 'Debes ingresar un Editorial';
    }
    if ($imagen === '') {
        $errores[] = 'Debes ingresar un Imagen';
    }

// IF DE CONTROL
// Si el array ---> Errores permanece vacío (que no acumulo errores), entonces los valores de las variables se van a insertar en sus respectivos atributos de la B_D con un query, y de paso nos regresara al index (menu).
    if (empty($errores)) {

         // Se crea una variable para insertar los valores de las variables a los atributos de la tabla libros.
        $peticionInsertar = "INSERT INTO libros (isbn, nombre, autor, precio, editorial, imagen) VALUES ('$isbn', '$nombre', '$autor', '$precio', '$editorial', '$imagen')";

        if (mysqli_query($conexion,$peticionInsertar)) {
            header("location:../index.php");  //Redirige al index donde esta el menu.
            exit();
        }
        else
        {
            header("Location: mensaje_error.php"); // Si hay errores dentro del array, emtonces nos mandará a la pagina de mensaje_errores.
            exit();
        }
    }
    else{
        header("Location: mensaje_error.php"); // En el caso de que los valores de las variables no se puedan insertar en los atributos, tambien redirige a mensaje_error.
        exit();
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear un libro</title>
</head>

<body>
    <a href="../index.php">Regresar</a>

    <form action="crear.php" method="POST">
        <label for="">ISBN</label>
        <input type="text" name="isbn">
        <label for="">Nombre</label>
        <input type="text" name="nombre">
        <label for="">Autor</label>
        <input type="text" name="autor">
        <label for="">Precio</label>
        <input type="number" name="precio">
        <label for="">Editorial</label>
        <input type="text" name="editorial">
        <label for="">Imagen</label>
        <input type="text" name="imagen">
        <input type="submit" value="Envíar">
    </form>
</body>

</html>