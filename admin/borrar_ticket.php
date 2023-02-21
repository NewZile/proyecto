<?php
// Conectar a la base de datos
$conn = mysqli_connect("localhost", "root", "", "contacto");

// Verificar si se ha establecido la conexión a la base de datos
if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener el ID del ticket a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID de ticket no especificado.");
}

// Ejecutar la consulta SQL para eliminar el registro
$sql = "DELETE FROM contactos WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "El ticket se ha eliminado correctamente.";
    header('Location: ticket.php');
} else {
    echo "Error al eliminar el ticket: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

