<?php
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
    <link rel="website icon" type="png" href="../img/fondo/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <style>
        .gradient-custom-2 {
            background: rgb(0, 0, 0);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        .wa:hover {
            text-decoration-line: underline;
            text-decoration-color: rgb(3, 69, 252);
        }

        .wa {
            text-decoration: none;
        }

        #message-container {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .error {
            color: #dc3545;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            border-color: #c3e6cb;
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
                <ul class="navbar-nav me-auto"> <!-- Agregamos la clase "ms-auto" -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../agenda.php">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../examen/preguntas_examen.html">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../estadisticas/Estadisticas.html">Estadisticas</a>
                    </li>
                    <li class="nav-item me-auto"> <!-- Agregamos la clase "me-auto" -->
                        <a class="nav-link active" href="usuario/usuario.php">
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


        <?php if(isset($_GET['mensaje'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_GET['mensaje']; ?>
    </div>
    <?php endif; ?>

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img id="logo"
                                            src="https://preview.redd.it/rqassez3kc591.png?width=841&format=png&auto=webp&s=a2035dca162b77fb88961464e73a1c57efe95cca"
                                            style="width: 200px; height: 200px; margin-bottom:5%" alt="logo">
                                        <h4 class="mt-1  pb-1">Contacta con ValorantStats</h4>
                                    </div>
                                    <form method="post" action="guardar.php">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="nombre">Nombre:</label>
                                            <input class="form-control" type="text" name="nombre" id="nombre"
                                                required><br>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="correo">Correo electrónico:</label>
                                            <input class="form-control" type="email" name="correo" id="correo"
                                                required><br>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="mensaje">Mensaje:</label>
                                            <textarea class="form-control" name="mensaje" id="mensaje"></textarea required><br>
                                        </div>
                                        <input class="btn btn-outline-success" type="submit" value="Enviar">
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">CONTACTO</h4>
                                    <p class="small mb-0">Valorant es un hero shooter en primera persona multijugador
                                        gratuito
                                        desarrollado y publicado por Riot Games.
                                        El juego se anunció por primera vez con el nombre en clave Project A en octubre
                                        de
                                        2019.
                                        Fue lanzado para Microsoft Windows el 2 de junio de 2020 después de su beta
                                        cerrada
                                        lanzada el 7 de
                                        abril de 2020.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


</html>