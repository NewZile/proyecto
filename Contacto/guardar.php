<?php
$mensaje = '';
// Obtener los datos del formulario y limpiarlos
$nombre = htmlspecialchars(trim($_POST['nombre']));
$correo = htmlspecialchars(trim($_POST['correo']));
$mensaje = htmlspecialchars(trim($_POST['mensaje']));

// Validar los datos del formulario
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Error: dirección de correo electrónico no válida");
}

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "contacto");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error: no se pudo conectar a la base de datos");
}

// Insertar los datos en la tabla
$sql = "INSERT INTO contactos (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";
if (!mysqli_query($conexion, $sql)) {
    die("Error: no se pudo insertar los datos en la base de datos");
}

// Cerrar la conexión
mysqli_close($conexion);

// Redirigir al usuario de vuelta al formulario con un mensaje de éxito
header("Location: contacto.php?mensaje=Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.");

?>
