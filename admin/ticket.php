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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body {
            background-image: url(fondo_pagina_principal.png);
            background-color: #F5F5F5;
        }

        h1 {
        color: #333;
        margin-bottom: 40px;
        }

        .container {
        background-color: #f8f8f8;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        padding: 2rem;
        }

        table {
        border-collapse: collapse;
        margin-top: 1rem;
        width: 100%;
        }

        thead {
        background-color: #333;
        color: #fff;
        }

        th, td {
        padding: 1rem;
        text-align: left;
        }

        th {
        font-weight: bold;
        }

        tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
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
                        <a class="nav-link active" href="administracion.php">Administración</a>
                    </li>
                    <li class="nav-item me-auto"> <!-- Agregamos la clase "me-auto" -->
                        <a class="nav-link active" href="../usuario/usuario.php">
                        <?php echo $row['name']; ?>
                        </a>
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


<?php
// Conectar a la base de datos
$conn = mysqli_connect("localhost", "root", "", "contacto");

// Verificar si se ha establecido la conexión a la base de datos
if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos de la base de datos
$sql = "SELECT * FROM contactos";
$resultado = mysqli_query($conn, $sql);

// Mostrar los datos en pantalla
if (mysqli_num_rows($resultado) > 0) {
    ?>
    <h1 class="text-center" style="color:white;">Lista de tickets</h1>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Mensaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $fila["id"]; ?></td>
                        <td><?php echo $fila["nombre"]; ?></td>
                        <td><?php echo $fila["correo"]; ?></td>
                        <td><?php echo $fila["mensaje"]; ?></td>
                        <td class="actions">
                            <a href="borrar_ticket.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    <?php
} else {
    echo "No se encontraron tickets.";
}


// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
</body>
</html>