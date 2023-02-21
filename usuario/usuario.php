<?php
// Iniciar la sesión
session_start();

// Verificar si hay una sesión iniciada
if (isset($_SESSION["user_id"])) {
    // Obtener el ID del usuario que inició sesión
    $user_id = $_SESSION["user_id"];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php_login_base";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener la información del usuario
    $sql = "SELECT name, email FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar la información del usuario
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontró el usuario";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Debes iniciar sesión para ver esta página";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Usuario</title>
    <style>
        /* Estilos CSS */
        body {
            background-image: url(../img/fondo/fondo_pagina_principal.png);
        }

        .user-info {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
            margin: 0 auto;
        }

        .user-info h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .user-info ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .user-info li {
            margin-bottom: 10px;
        }

        .user-info label {
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
            width: 150px;
        }

        .user-info span {
            font-weight: normal;
        }

        .editar-perfil-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
        }

        .editar-perfil-btn:hover {
            background-color: #3e8e41;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- icono o nombre -->

            <a class="navbar-brand" href="../pagina_administracion.php">
                <i class="bi bi-flower1"></i>
                <span class="text-warning">ValorantStats</span>
            </a>

            <!-- boton del menu -->

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- elementos del menu colapsable -->

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../agenda.php">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../examen/preguntas_examen.html">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../Estadisticas/Estadisticas.html">Estadisticas</a>
                    </li>
                    <li class="nav-item dropdown">

                    </li>
                </ul>

                <hr class="d-md-none text-white-50">
                <!--boton Informacion -->

                <form class="d-flex">
                    <a class="btn btn-outline-warning d-none d-md-inline-block" href="../logout.php">
                        Cerrar Sesion
                    </a>
                </form>
            </div>

        </div>
    </nav>

    <div class="user-info">
        <h2 style="color:black;">Datos del usuario</h2>
        <ul>
            <li>
                <label for="name">Nombre:</label>
                <?php echo $row['name']; ?>
            </li>
            <li>
                <label for="email">Correo electrónico:</label>
                <?php echo $row['email']; ?>
            </li>
        </ul>
        <a href="editar-perfil.php" class="editar-perfil-btn">Editar ajustes de usuario</a>
    </div>

</body>

</html>