<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "php_login_base");

// Verificación de la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$message = '';

// Verificación de la acción de edición
if (isset($_POST['edit_user'])) {
    // Recuperación de datos del formulario
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $permisos = $_POST['permisos'];
    // $password = $_POST['password'];

    // Actualización de los datos en la base de datos
    // $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id'";
    $sql = "UPDATE users SET name='$name', permisos='$permisos', email='$email' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        $message = 'Se ha actualizado perfectamente el usuario';
        $message_class = 'success';
    } else {
        $message = 'Error al actualizar el usuario:';
        $message_class = 'error';
    }
}

// Consulta para recuperar los datos del usuario
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Cierre de la conexión a la base de datos
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Modificar Usuario</title>
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

        .message.error {
            color: red;
        }

        .message.success {
            color: green;
        }
    </style>
</head>

<body>
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
                                        <h4 class="mt-1  pb-1">Actualizar Perfil</h4>
                                    </div>
                                    <!-- Formulario de edición de usuario -->
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name">Nombre:</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="<?php echo $user['name']; ?>">
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Email:</label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                value="<?php echo $user['email']; ?>"><br>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="permisos">Permisos:</label>
                                                <input placeholder="Coloce admin o usuario" class="form-control"
                                                    type="text" id="permisos" name="permisos"
                                                    value="<?php echo $user['permisos']; ?>"><br>
                                            </div>
                                            <div class="message <?php echo $message_class; ?>"><?php echo $message; ?>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-danger" type="submit" name="edit_user">Guardar
                                            cambios</button>
                                        <button class="btn btn-outline-danger" type="button"
                                            onclick="window.location='administracion.php'">Atras</button>

                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">VALORANT</h4>
                                    <p class="small mb-0">Valorant es un hero shooter en primera persona multijugador
                                        gratuito
                                        desarrollado y publicado por Riot Games.
                                        El juego se anunció por primera vez con el nombre en clave Project A en octubre
                                        de 2019.
                                        Fue lanzado para Microsoft Windows el 2 de junio de 2020 después de su beta
                                        cerrada lanzada el 7 de
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