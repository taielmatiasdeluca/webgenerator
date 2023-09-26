<?php 
	session_start();
	include 'libs/tools.php';

	if(!isset($_SESSION[SESSIONID])){
		header('Location: login.php');
	}

	$error = '';

	if(isset($_GET['mode'])){
		$id=$_GET['id'];
		$post = getWebById($id);
		switch($_GET['mode']){
			case 'download':
				$file_path = 'downloads/'.$post['dominio'].'.zip';
				if(file_exists('../'.$file_path)){
					shell_exec("rm -rf ../$file_path");
				}
				shell_exec("zip -r ../$file_path ../".$post['dominio']);
				header("Location: ../$file_path");
				break;
			case 'delete':
				if($post['idUsuario'] != $_SESSION[SESSIONID]){
					header('Location: panel.php');
				}
				if(deleteWeb($id,$_SESSION[SESSIONID])){
					shell_exec('rm -rf ../'.$post['dominio']);
				}
				header('Location: panel.php');
				break;
		}
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_SESSION[SESSIONID].$_POST['name'];
		if(!isWeb($name)){
			if(insertWeb($_SESSION[SESSIONID],$name)){
				$line = './wix.sh ../'.$name.' '.$_SESSION[SESSIONID];
				shell_exec($line);
				header('Location: panel.php');
			}
			$error = 'No se pudo insertar la web';
		}
		$error = 'Ya tiene una web con ese dominio';
	}
	if($_SESSION[SESSIONID] == 4){
		$webs = getAllWebs();	
	}else{
		$webs = getWebs($_SESSION[SESSIONID]);
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel</title>
</head>
<body>
	<h1>Panel</h1>
	<h2 class="error"><?= $error?></h2>
	<form action="" method="POST">
		<span>
			<label for="name">Generar web de: </label>
			<input type="text" name="name" id="">
		</span>
		<input type="submit" value="Crear Web">

	</form>

	<table border="1">
		<tr>
			<th>Dominio</th>
			<th>Descargar</th>
			<th>Eliminar</th>
		</tr>
		<?php foreach ($webs as $key => $web): ?>
			<tr>
				<td><a href="<?= URL.'/'.$web['dominio'] ?>"><?=$web['dominio']?></a></td>
				<td><a href="?mode=download&id=<?=$web['idWeb']?>">Descargar</a></td>
				<td><a href="?mode=delete&id=<?=$web['idWeb']?>">Eliminar</a></td>
			</tr>
		<?php endforeach ?>

	</table>

	<a href="logout.php">Cerrar sesion de <?= $_SESSION[SESSIONID] ?></a>

</body>
</html>