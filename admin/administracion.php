<?php
session_start();


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

if (!isset($_SESSION["user_id"]) || $_SESSION["permisos"] != "admin") {
    header("Location: pagina_user.php");
    http_response_code(302);
    die();
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Panel de Administración</title>
    <style>
        body {
            background-image: url(fondo_pagina_principal.png);
            background-color: #F5F5F5;
        }

        @media only screen and (max-width: 767px) {
            .table {
                display: block;
                overflow-x: auto;
            }
        }

        h1 {
        color: #333;
        margin-bottom: 40px;
    }

    .container {
        background-color: #FFF;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px #BBB;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: #333;
        color: #FFF;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        font-weight: bold;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .btn {
        margin-left: 10px;
        transform: translateY(-4px);
        transition: all 0.3s ease-in-out;
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
                        <a class="nav-link active" href="ticket.php">Tickets</a>
                    </li>
                    <li class="nav-item me-auto"> <!-- Agregamos la clase "me-auto" -->
                        <a class="nav-link active" href="../usuario/usuario.php">
                        <?php echo $row['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">

                    </li>
                </ul>

                <hr class="d-md-none text-white-50">
                <!--boton Informacion -->
                <form class="d-flex">
                    <a class="btn btn-outline-warning d-none d-md-inline-block" href="logout.php">
                        Cerrar Sesion
                    </a>
                </form>
            </div>

        </div>
    </nav>


    <!-- Encabezado -->
    <h1 class="text-center" style="color:white;">Panel de Administración de Usuarios</h1>

    <!-- Contenedor principal -->
    <div class="container mt-5">
        <!-- Tabla de usuarios -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "php_login_base");
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo strtoupper($row['name']); ?>
                        </td>
                        <td>
                            <?php echo $row['email']; ?>
                        </td>
                        <td>
                            <?php echo $row['permisos']; ?>
                        </td>
                        <td>
                            <form>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" formaction="edit.php" class="btn btn-primary">Editar</button>
                                <button type="submit" formaction="delete.php" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php mysqli_close($conn); ?>
            </tbody>
        </table>
    </div>


</body>

</html>