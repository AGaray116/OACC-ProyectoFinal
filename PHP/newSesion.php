<?php

include_once 'database.php';

session_start();
if(isset($_GET['cerrar_sesion'])){
	session_unset();
	session_destroy();
}

if(isset($_SESSION['rol'])){
	switch($_SESSION['rol']){
		case 1:
			header('Location: http://localhost/Igeai/index.php');
		break;

		case 2:
			header('Location: http://localhost/Igeai/html/administrador.html');
		break;

		case 3:
			header('Location: http://localhost/Igeai/html/agendar_cita.html');
		break;
		case 4:
			header('Location: http://localhost/Igeai/html/adminSecretaria.html');
		break;

		default:
	}
}

if(isset($_POST['correo']) && isset($_POST['contrasena'])){
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];
    $db = new DB();
    $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE correo_uss = :correo AND contrasena_uss = :contrasena');
    $query->execute(['correo' => $correo, 'contrasena' => $password]);

	$row = $query -> fetch(PDO::FETCH_NUM);

	if($row == true){
		$rol = $row[1];
		$correo = $row[2];
		$_SESSION['rol'] = $rol;
		$_SESSION['user'] = $correo;
		switch($_SESSION['rol']){
			case 1:
				header('Location: ../index.php');
			break;
	
			case 2:
				header('Location: ../index.php');
			break;
	
			case 3:
				header('Location: ../index.php');
			break;
			case 4:
				header('Location: ../index.php');
			break;
	
			default:
		}
	}else{
		echo '<script> alert("Contraseña Incorrecta"); window.location.href="../html/iniciarSesion.html";  </script>';
		
	}


}

?> 
