<?php
	session_start();
	$error = '';
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include 'libs/tools.php';
		$db = dbConnect();
		$email = $_POST['email'];
		$pass =$_POST['password'];
		$response = $db->query("SELECT idUsuario FROM usuarios where email='$email' and password='$pass'");
		if(!$db->error){
			if($response->num_rows ==1){
				$info = $response->fetch_all(MYSQLI_ASSOC)[0]['idUsuario'];
				$_SESSION[SESSIONID] = $info;
				header('Location: panel.php');
			}
			$error = 'Error en las credenciales';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>webgenerator Taiel De Luca</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/forms.css">
</head>
<body>
	<content>
		<h1>Inicio de Sesion</h1>
		<h2 class="error"><?= $error ?></h2>
		<form action="" method="POST">
			<label for="email">Email</label>
			<input type="email" name="email" id="email__txt">
			<label for="password">Password</label>
			<input type="password" name="password" id="password__txt">
			<input type="submit" value="Iniciar">
		</form>
		<a href="register.php">Crear Cuenta</a>
	</content>
	
</body>
</html>