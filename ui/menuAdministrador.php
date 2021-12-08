<?php
$administrador = new Administrador($_SESSION['id']);
$administrador -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrador.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/insertAdministrador.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/areas/insertAreas.php") ?>">Areas</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cargo/insertCargo.php") ?>">Cargo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/empleado/insertEmpleado.php") ?>">Empleado</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Consultar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/selectAllAdministrador.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/areas/selectAllAreas.php") ?>">Areas</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cargo/selectAllCargo.php") ?>">Cargo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleado.php") ?>">Empleado</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Buscar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/searchAdministrador.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/areas/searchAreas.php") ?>">Areas</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cargo/searchCargo.php") ?>">Cargo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/empleado/searchEmpleado.php") ?>">Empleado</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Log</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logAdministrador/searchLogAdministrador.php") ?>">Log Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logEmpleado/searchLogEmpleado.php") ?>">Log Empleado</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Administrador: <?php echo $administrador -> getNombre() . " " . $administrador -> getApellido() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/updateProfileAdministrador.php") ?>">Editar Perfil</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/updatePasswordAdministrador.php") ?>">Editar Clave</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/updateProfilePictureAdministrador.php") ?>">Editar Foto</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Salir</a>
			</li>
		</ul>
	</div>
</nav>
