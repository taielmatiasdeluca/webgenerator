<?php
	session_start();
	$error = '';
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include 'libs/tools.php';
		$db = dbConnect();

		$email = $_POST['email'];
		$pass = $_POST['password'];
		if($reponse = $db->query("SELECT idUsuario FROM usuarios where email='$email'")){
			if($reponse->num_rows >=1){
				$error = 'Email ya registrado';
			}
			else{
				$sql = "INSERT INTO `usuarios` (`email`, `password`) VALUES (?,?);";
				$query = $db->prepare($sql);
				$query->bind_param('ss',$_POST['email'],$_POST['password']);
				if($query->execute()){
					$_REQUEST[SESSIONID] = $query->insert_id;
					header('Location: panel.php');
				}
				$error = 'Verificar Credenciales';
			}
		}
	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrarte es simple</title>
	<link rel="stylesheet" href="css/forms.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<content>
		<h1>Registrarte es simple</h1>
		<h2 id="h2__error" class="error"><?= $error ?></h2>
		<form id="main__form" action="" method="POST">
			<label for="email">Email</label>
			<input type="email" name="email" id="email__txt">
			<label for="password">Password</label>
			<input type="password" name="password" id="password__txt">
			<label >Confirmar Contraseña</label>
			<input type="password" id="re_password__txt">
			<input type="submit" value="Iniciar">
		</form>

	</content>

	<script>
		main__form.addEventListener('submit',e=>{
			e.preventDefault();
			if(password__txt.value == re_password__txt.value){
				main__form.submit();
			}
			h2__error.textContent = 'No coinciden las contraseñas';
		});

	</script>
</body>
</html>