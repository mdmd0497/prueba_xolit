<?php 
session_start();
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Areas.php");
require("business/Cargo.php");
require("business/LogEmpleado.php");
require("business/Empleado.php");
ini_set("display_errors","1");
date_default_timezone_set("America/Bogota");
$webPagesNoAuthentication = array(
	'ui/recoverPassword.php',
);
$webPages = array(
	'ui/sessionAdministrador.php',
	'ui/administrador/insertAdministrador.php',
	'ui/administrador/updateAdministrador.php',
	'ui/administrador/selectAllAdministrador.php',
	'ui/administrador/searchAdministrador.php',
	'ui/administrador/updateProfileAdministrador.php',
	'ui/administrador/updatePasswordAdministrador.php',
	'ui/administrador/updateProfilePictureAdministrador.php',
	'ui/administrador/updateFotoAdministrador.php',
	'ui/logAdministrador/searchLogAdministrador.php',
	'ui/areas/insertAreas.php',
	'ui/areas/updateAreas.php',
	'ui/areas/selectAllAreas.php',
	'ui/areas/searchAreas.php',
	'ui/cargo/insertCargo.php',
	'ui/cargo/updateCargo.php',
	'ui/cargo/selectAllCargo.php',
	'ui/cargo/searchCargo.php',
	'ui/logEmpleado/searchLogEmpleado.php',
	'ui/sessionEmpleado.php',
	'ui/empleado/insertEmpleado.php',
	'ui/empleado/updateEmpleado.php',
	'ui/empleado/selectAllEmpleado.php',
	'ui/empleado/searchEmpleado.php',
	'ui/empleado/updateProfileEmpleado.php',
	'ui/empleado/updatePasswordEmpleado.php',
	'ui/empleado/updateProfilePictureEmpleado.php',
	'ui/areas/selectAllAreasByEmpleado.php',
	'ui/empleado/updateFotoEmpleado.php',
);
if(isset($_GET['logOut'])){
	$_SESSION['id']="";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>emp</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/png" href="img/logo.png" />
		<link href="https://bootswatch.com/4/sketchy/bootstrap.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
		<script charset="utf-8">
			$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
	</head>
	<body>
		<?php
		if(empty($_GET['pid'])){
			include('ui/home.php' );
		}else{
			$pid=base64_decode($_GET['pid']);
			if(in_array($pid, $webPagesNoAuthentication)){
				include($pid);
			}else{
				if($_SESSION['id']==""){
					header("Location: index.php");
					die();
				}
				if($_SESSION['entity']=="Administrador"){
					include('ui/menuAdministrador.php');
				}
				if($_SESSION['entity']=="Empleado"){
					include('ui/menuEmpleado.php');
				}
				if (in_array($pid, $webPages)){
					include($pid);
				}else{
					include('ui/error.php');
				}
			}
		}
		?>
		<div class="text-center text-muted"> &copy; <?php echo date("Y")?></div>
	</body>
</html>
