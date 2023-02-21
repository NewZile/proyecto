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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Pagina Principal</title>
  <style>
    body {
      background-image: url(img/fondo/fondo_pagina_principal.png);
    }

    .wa:hover {
      text-decoration-line: underline;
      text-decoration-color: rgb(3, 69, 252);
    }

    .wa {
      text-decoration: none;
    }

    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap');

    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      text-align: center;
    }

    body {
      background-color: #eee;
      min-height: 100vh;
      font-family: 'Open Sans', sans-serif;
    }

    .card {
      display: inline-block;
      position: relative;
      width: 400px;
      min-width: 400px;
      height: 400px;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
      margin: 30px;
    }

    .image {
      height: 70%;
    }

    .text_container {
      position: absolute;
      top: 55%;
      left: -5px;
      height: 65%;
      width: 108%;
      background-image: linear-gradient(0deg, #3f5efb, #fc466b);
      border-radius: 30px;
      transform: skew(19deg, -9deg);
    }

    .text_container:hover {
      background-image: linear-gradient(0deg, #fc466b, #3f5efb);
    }


    .second .text_container {
      background-image: linear-gradient(-20deg, #bb7413, #e7d25c);
    }

    .second .text_container:hover {
      background-image: linear-gradient(-20deg, #e7d25c, #bb7413);
    }

    .logo {
      height: 80px;
      width: 80px;
      border-radius: 20px;
      background-color: #fff;
      position: absolute;
      left: 30px;
      bottom: 30%;
      overflow: hidden;
      box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.7);
    }

    .logo img {
      height: 100%;
    }

    .main_text {
      position: absolute;
      color: #fff;
      font-weight: 900;
      left: 150px;
      bottom: 26%;
    }

    .card_btn {
      position: absolute;
      color: #fff;
      right: 30px;
      bottom: 10%;
      padding: 10px 20px;
      border: 1px solid #fff;
      animation: animate 2s ease 0s infinite normal forwards;
    }

    @keyframes animate {
      0% {
        transform: translate(0);
      }

      20% {
        transform: translate(-2px, 2px);
      }

      40% {
        transform: translate(-2px, -2px);
      }

      60% {
        transform: translate(2px, 2px);
      }

      80% {
        transform: translate(2px, -2px);
      }

      100% {
        transform: translate(0);
      }
    }

    .card_btn:hover {
      animation: none;
    }

    .card_btn a {
      color: #fff;
    }

    .date {
      position: absolute;
      color: #fff;
      left: 30px;
      bottom: 10%;
    }
  </style>
</head>

<body class="bg-secondary">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- icono o nombre -->

      <a class="navbar-brand" href="#">
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
            <a class="nav-link active" aria-current="page" href="agenda.html">Calendario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="examen/preguntas_examen.html">Examen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Estadisticas/Estadisticas.html">Estadisticas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="usuario/usuario.php">
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>


  <div class="first card">
    <img src="img/personajes/jett.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="agentes/jett.html">Mas Información</a>
    </div>
  </div>
  <div class="second card">
    <img src="img/personajes/reyna.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>02.06.2020</p>
    </div>
    <div class="card_btn">
      <a href="agentes/reyna.html">Mas Información</a>
    </div>
  </div>
  <div class="first card">
    <img src="img/personajes/phoenix.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="agentes/phoenix.html">Mas Información</a>
    </div>
  </div>
  <div class="first card">
    <img src="img/personajes/yoru.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>12.01.2021</p>
    </div>
    <div class="card_btn">
      <a href="agentes/yoru.html">Mas Información</a>
    </div>
  </div>
  <div class="second card">
    <img src="img/personajes/neon.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>11.01.2022</p>
    </div>
    <div class="card_btn">
      <a href="agentes/neon.html">Mas Información</a>
    </div>
  </div>
  <div class="first card">
    <img src="img/personajes/fade.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>27.04.2022</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <div class="first card">
    <img src="img/personajes/kj.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>04.08.2020 </p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>


  <div class="second card">
    <img src="img/personajes/viper.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>


  <div class="first card">
    <img src="img/personajes/chamber.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>16.11.2021</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <div class="first card">
    <img src="img/personajes/harbor.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>12.12.2022</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>


  <div class="second card">
    <img src="https://www.xtrafondos.com/wallpapers/kayo-valorant-juego-10635.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>22.06.2021</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <div class="first card">
    <img src="img/personajes/omen.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <div class="first card">
    <img src="img/personajes/brim.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>


  <div class="second card">
    <img src="img/personajes/raze.png" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>



  <div class="first card">
    <img src="img/personajes/astra.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>02.03.2021</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>




  <div class="first card">
    <img src="img/personajes/cypher.png" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>


  <div class="second card">
    <img src="img/personajes/breach.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <div class="first card">
    <img src="img/personajes/sage.png" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <div class="second card">
    <img src="img/personajes/skye.jpg" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>02.11.2020 </p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>


  <div class="first card">
    <img src="img/personajes/sova.png" alt="" class="image">
    <div class="text_container"></div>
    <div class="logo">
      <img src="img/fondo/logo.png" alt="">
    </div>
    <div class="main_text">
      <p>Para mas información visite la siguiente imagen</p>
    </div>
    <div class="date">
      <p>7.04.2020</p>
    </div>
    <div class="card_btn">
      <a href="#">Mas Información</a>
    </div>
  </div>

  <footer class=" bg-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.87) ; color: white;  ">
      ValorantStats
    </div>
  </footer>

</body>

</html>