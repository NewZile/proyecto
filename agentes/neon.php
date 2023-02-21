<!DOCTYPE html>
<html lang="es">

<head name="viewport" y content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Neon</title>
    <style>
        body {
            background-image: url(/proyecto-main/img/fondo/fondo_pagina_principal.png);
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(57, 18, 148, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(28, 11, 126, 0.5);
        }

        button {
            width: 75px;
            height: 75px;
            border-radius: 0;
            align-items: center;
            padding: 10px;
            margin: 10px;
            color: rgb(0, 0, 0);
            cursor: pointer;
            position: relative;
            margin-left: 5%;
        }

        .mi-imagen {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            max-height: 100%;
        }

        #neon {
            width: 400px;
        }
    </style>
    <script>
        function playVideo(videoId) {
            var videoPlayer = document.getElementById("videoPlayer");
            if (videoPlayer) {
                videoPlayer.src = `videos/${videoId}.mp4`;
                videoPlayer.loop = true;
                videoPlayer.play();
            }
        }

        window.addEventListener("load", () => {
            document.querySelector("body > div.container > button:nth-child(2) > img").click();

            let is_started = false;

            window.addEventListener("mousemove", () => {
                if (is_started) { return; }
                is_started = !is_started;
                console.log("click");

                document.querySelector("body > div.container > button:nth-child(2) > img").click();
            })
        })


    </script>
</head>

<body>

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
                        <a class="nav-link active" aria-current="page" href="../agenda.html">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../examen/preguntas_examen.html">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../Estadisticas/Estadisticas.html">Estadisticas</a>
                    </li>
                    <li class="nav-item dropdown">
                    <li class="nav-item">
                        <a class="nav-link active" href="../usuario/usuario.php">
                            <?php echo $row['name']; ?>
                        </a>
                    </li>
                    </li>
                </ul>

                <hr class="d-md-none text-white-50">
                <!--boton Informacion -->
                <!--boton Informacion -->
                <form class="d-flex">
                    <a class="btn btn-outline-warning d-none d-md-inline-block" href="../logout.php">
                        Cerrar Sesion
                    </a>
                </form>
            </div>

        </div>
    </nav>

    <div class="row col-sm-12">
        <div class="col-sm-8">
            <img id="neon" src="img/neon/neon.png" class="mx-auto d-block img-sm">
        </div>
        <div class="col-sm-2"><br>
            <div class="text-right" style="color: white; margin-left: -60%;">
                <b>//ROL</b><br><br>
                <h2>DUELISTA</h2><br>
                <b>//BIOGRAFIA</b><br><br>
                <b>La agente filipina, Neon, avanza a velocidades impactantes, descargando ráfagas de energía
                    bioeléctrica tan rápido como su cuerpo la genera. Se adelanta velozmente a sus enemigos para
                    atraparlos desprevenidos y luego los fulmina más rápido que un rayo.
                </b>
            </div>
        </div>
    </div>
    <div class="container">
        <button onclick="playVideo('videoneon1')">
            <img class="mi-imagen" src="img/neon/Q.png">
        </button>
        <button onclick="playVideo('videoneon2')">
            <img class="mi-imagen" src="img/neon/E.png" alt="">

        </button>
        <button onclick="playVideo('videoneon3')">
            <img class="mi-imagen" src="img/neon/C.png" alt="">

        </button>
        <button onclick="playVideo('videoneon4')">
            <img class="mi-imagen" src="img/neon/X.png" alt="">
        </button>

        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsiv" id="videoPlayer" width="620" height="340"
                style="position: absolute; right: 2rem; bottom: -6rem;"></video>
        </div>
    </div>


</body>

</html>