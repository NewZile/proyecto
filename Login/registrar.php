<?php
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "proyecto";

//Creating a connection
$con = mysqli_connect($host, $username, $passwd, $dbname);

if ($con) {
	print("Conexión Correctamente");
} else {
	print("Connection Failed ");
}



// Recogemos la información del formulario
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validamos la información
if (empty($username)) {
	// El nombre de usuario está vacío, mostramos un mensaje de error
	echo 'Por favor ingresa un nombre de usuario';
} else if (empty($email)) {
	// La dirección de correo electrónico está vacía, mostramos un mensaje de error
	echo 'Por favor ingresa una dirección de correo electrónico';
} else if (empty($password)) {
	// La contraseña está vacía, mostramos un mensaje de error
	echo 'Por favor ingresa una contraseña';
} else {
	// La información es válida, procedemos a verificar si el usuario y la dirección de correo electrónico ya existen
	// (omitimos este paso en el ejemplo por simplicidad)

	// Si el usuario y la dirección de correo electrónico son válidos, procedemos a registrar al usuario
	// (omitimos este paso en el ejemplo por simplicidad)
	echo 'Usuario registrado correctamente';
}

?>