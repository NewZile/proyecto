<?php

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['name'])) {
	if (strlen($_POST['password']) < 8) {
		$message = 'La contraseña debe tener al menos 8 caracteres.';
		$message_class = 'error';
	} else if ($_POST['password'] != $_POST['confirm_password']) {
		$message = 'Las contraseñas no coinciden.';
		$message_class = 'error';
	} else {
		// Validación para verificar que el correo electrónico sea válido
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$message = 'Por favor, ingrese un correo electrónico válido';
			$message_class = 'error';
		} else {
			// Consulta para verificar si el correo ya existe en la tabla de usuarios
			$check_email = "SELECT email FROM users WHERE email = :email";
			$stmt_check = $conn->prepare($check_email);
			$stmt_check->bindParam(':email', $_POST['email']);
			$stmt_check->execute();

			// Si no existe el correo, se inserta el usuario
			if ($stmt_check->rowCount() == 0) {
				$sql = "INSERT INTO users (name, email, password, permisos) VALUES (:name, :email, :password, :permisos)";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':name', $_POST['name']);
				$stmt->bindParam(':email', $_POST['email']);
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$stmt->bindParam(':password', $password);
				$permisos = "usuario";
				$stmt->bindParam(':permisos', $permisos);

				if ($stmt->execute()) {
					$message = 'Se ha creado perfectamente el usuario';
					$message_class = 'success';
				} else {
					$message = 'Lo siento, ha ocurrido un problema al crear tu cuenta. Por favor, inténtalo de nuevo más tarde.';
					$message_class = 'error';
				}
			} else {
				$message = 'Lo siento, el correo ya está en uso. Por favor, utiliza una dirección de correo electrónico diferente.';
				$message_class = 'error';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registro</title>
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
							<div class="col-lg-6">
								<div class="card-body p-md-5 mx-md-4">

									<div class="text-center">
										<img id="logo"
											src="https://preview.redd.it/rqassez3kc591.png?width=841&format=png&auto=webp&s=a2035dca162b77fb88961464e73a1c57efe95cca"
											style="width: 200px; height: 200px; margin-bottom:5%" alt="logo">
										<h4 class="mt-1  pb-1">Bienvenido a ValorantStats</h4>
									</div>


									<form action="index.php" method="POST">

										<div class="form-outline mb-4">
											<label class="form-label" for="name">Usuario</label>
											<input name="name" type="text" placeholder="Introduzca tu Nombre"
												class="form-control">
										</div>
										<div class="form-outline mb-4">
											<label class="form-label" for="email">Email</label>
											<input name="email" type="text" placeholder="Introduzca tu Email"
												class="form-control">
										</div>
										<div class="form-outline mb-4">
											<label class="form-label" for="email">Contraseña</label>
											<input name="password" type="password"
												placeholder="Introduzca su Contraseña" class="form-control">
										</div>
										<div class="form-outline mb-4">
											<label class="form-label" for="email">Vuelve a introducir la
												contraseña</label>
											<input name="confirm_password" type="password"
												placeholder="Introduzca su Contraseña" class="form-control">
										</div>
										<div id="message-container">
											<div class="message <?php echo $message_class; ?>"><?php echo $message; ?>
											</div><br>
											<div class="d-flex align-items-center justify-content-center pb-4">
												<input class="btn btn-outline-danger" type="submit" value="Registrar">
												<span><a class="btn btn-outline-danger" href="login.php">Inicia
														Sesion</a></span>
											</div>

										</div>
								</div>
								</form>
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