<?php

session_start();

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  // Sanitizar la entrada de datos
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  // Utilizar consultas preparadas
  $stmt = $conn->prepare('SELECT id, email, password, permisos FROM users WHERE email = :email');
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result && password_verify($password, $result['password'])) {
    // Verificar los datos de entrada
    $permisos = htmlspecialchars($result['permisos']);
    if ($permisos == 'admin') {
      header("Location: pagina_administracion.php");
    } elseif ($permisos == 'usuario') {
      header("Location: pagina_user.php");
    } else {
      header("Location: pagina_principal.html");
    }

    $_SESSION["user_id"] = $result["id"];
    $_SESSION["permisos"] = $result["permisos"];


    http_response_code(302);
    die();
  } else {
    $message = 'Lo siento, las credenciales son incorrectas';
    $message_class = 'error';
  }
}

// if (!empty($_POST['email']) && !empty($_POST['password'])) {
//   // Validate email format
//   if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//     $message = 'Por favor ingrese un correo electrónico válido.';
//     $message_class = 'error';
//   } else {
//     // Validate password length
//     if (strlen($_POST['password']) < 8) {
//       $message = 'La contraseña debe tener al menos 8 caracteres.';
//       $message_class = 'error';
//     } else {
//       // Prepare statement
//       $stmt = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email LIMIT 1');
//       $stmt->bindParam(':email', $_POST['email']);
//       $stmt->execute();
//       $result = $stmt->fetch(PDO::FETCH_ASSOC);

//       // Verify password
//       if ($result && password_verify($_POST['password'], $result['password'])) {
//         $_SESSION['user_id'] = $result['id'];
//         header("Location: pagina_principal.html");
//       } else {
//         $message = 'Por favor introduzca bien las credenciales';
//         $message_class = 'error';
//       }
//     }
//   }
// }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

  <?php if (!empty($message)): ?>
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
                    <h4 class="mt-1  pb-1">Bienvenido a ValorantStats</h4>
                  </div>
                  <form action="login.php" method="POST">
                    <p style="text-align: center;">Porfavor introduzca sus credenciales</p>
                    <label class="form-label" for="form2Example11">Email</label>
                    <div class="form-outline mb-4">
                      <input name="email" type="text" placeholder="Introduzca su Email" class="form-control">
                    </div>
                    <label class="form-label" for="form2Example22">Contraseña</label>
                    <div class="form-outline mb-4">
                      <input name="password" type="password" id="password" placeholder="Introduzca su Contraseña"
                        class="form-control">
                    </div>
                    <div id="message-container">
                      <div class="message <?php echo $message_class; ?>"><?php echo $message; ?>
                      </div>
                    </div>
                    <input class="btn btn-outline-danger" type="submit" value="Iniciar Sesion">
                    <span><a class="btn btn-outline-danger" href="index.php">Registrate</a></span>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">VALORANT</h4>
                  <p class="small mb-0">Valorant es un hero shooter en primera persona multijugador gratuito
                    desarrollado y publicado por Riot Games.
                    El juego se anunció por primera vez con el nombre en clave Project A en octubre de 2019.
                    Fue lanzado para Microsoft Windows el 2 de junio de 2020 después de su beta cerrada lanzada el 7 de
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