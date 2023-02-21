<?php
include('database.php');

$message = '';

if (!empty($_GET['id'])) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);

    if ($stmt->execute()) {
        header('Location: administracion.php');
    } else {
        echo 'Lo siento, ha ocurrido un problema al eliminar el usuario';
    }
}