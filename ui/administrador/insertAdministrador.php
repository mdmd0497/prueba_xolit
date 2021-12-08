<?php
$processed=false;
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$apellido="";
if(isset($_POST['apellido'])){
	$apellido=$_POST['apellido'];
}
$correo="";
if(isset($_POST['correo'])){
	$correo=$_POST['correo'];
}
$clave="";
if(isset($_POST['clave'])){
	$clave=$_POST['clave'];
}
$telefono="";
if(isset($_POST['telefono'])){
	$telefono=$_POST['telefono'];
}
$celular="";
if(isset($_POST['celular'])){
	$celular=$_POST['celular'];
}
$estado="";
if(isset($_POST['estado'])){
	$estado=$_POST['estado'];
}
if(isset($_POST['insert'])){
	$newAdministrador = new Administrador("", $nombre, $apellido, $correo, $clave, "", $telefono, $celular, $estado);
	$newAdministrador -> insert();
	$user_ip = getenv('REMOTE_ADDR');
	$agent = $_SERVER["HTTP_USER_AGENT"];
	$browser = "-";
	if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
		$browser = "Internet Explorer";
	} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Chrome";
	} else if (preg_match('/Edge\/\d+/', $agent) ) {
		$browser = "Edge";
	} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Firefox";
	} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Opera";
	} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Safari";
	}
	if($_SESSION['entity'] == 'Administrador'){
		$logAdministrador = new LogAdministrador("","Crear Administrador", "Nombre: " . $nombre . "; Apellido: " . $apellido . "; Correo: " . $correo . "; Clave: " . $clave . "; Telefono: " . $telefono . "; Celular: " . $celular . "; Estado: " . $estado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Empleado'){
		$logEmpleado = new LogEmpleado("","Crear Administrador", "Nombre: " . $nombre . "; Apellido: " . $apellido . "; Correo: " . $correo . "; Clave: " . $clave . "; Telefono: " . $telefono . "; Celular: " . $celular . "; Estado: " . $estado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logEmpleado -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Crear Administrador</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/administrador/insertAdministrador.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Apellido*</label>
							<input type="text" class="form-control" name="apellido" value="<?php echo $apellido ?>" required />
						</div>
						<div class="form-group">
							<label>Correo*</label>
							<input type="email" class="form-control" name="correo" value="<?php echo $correo ?>"  required />
						</div>
						<div class="form-group">
							<label>Clave*</label>
							<input type="password" class="form-control" name="clave" value="<?php echo $clave ?>" required />
						</div>
						<div class="form-group">
							<label>Telefono</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $telefono ?>"/>
						</div>
						<div class="form-group">
							<label>Celular</label>
							<input type="text" class="form-control" name="celular" value="<?php echo $celular ?>"/>
						</div>
						<div class="form-group">
							<label>Estado</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="estado" value="1" checked />
							<label class="form-check-label">Habilitado</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="estado" value="0" />
							<label class="form-check-label" >Deshabilitado</label>
						</div>
						</div>
						<button type="submit" class="btn btn-info" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
