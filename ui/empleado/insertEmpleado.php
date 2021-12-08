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
$state="";
if(isset($_POST['state'])){
	$state=$_POST['state'];
}
$cargo="";
if(isset($_POST['cargo'])){
	$cargo=$_POST['cargo'];
}
if(isset($_GET['idCargo'])){
	$cargo=$_GET['idCargo'];
}
if(isset($_POST['insert'])){
	$newEmpleado = new Empleado("", $nombre, $apellido, $correo, $clave, "", $state, $cargo);
	$newEmpleado -> insert();
	$objCargo = new Cargo($cargo);
	$objCargo -> select();
	$nameCargo = $objCargo -> getN_cargo() ;
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
		$logAdministrador = new LogAdministrador("","Crear Empleado", "Nombre: " . $nombre . "; Apellido: " . $apellido . "; Correo: " . $correo . "; Clave: " . $clave . "; State: " . $state . "; Cargo: " . $nameCargo , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Empleado'){
		$logEmpleado = new LogEmpleado("","Crear Empleado", "Nombre: " . $nombre . "; Apellido: " . $apellido . "; Correo: " . $correo . "; Clave: " . $clave . "; State: " . $state . "; Cargo: " . $nameCargo , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Empleado</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/empleado/insertEmpleado.php") ?>" class="bootstrap-form needs-validation"   >
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
							<label>State*</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="state" value="1" checked />
							<label class="form-check-label">Habilitado</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="state" value="0" />
							<label class="form-check-label" >Deshabilitado</label>
						</div>
						</div>
					<div class="form-group">
						<label>Cargo*</label>
						<select class="form-control" name="cargo">
							<?php
							$objCargo = new Cargo();
							$cargos = $objCargo -> selectAllOrder("n_cargo", "asc");
							foreach($cargos as $currentCargo){
								echo "<option value='" . $currentCargo -> getIdCargo() . "'";
								if($currentCargo -> getIdCargo() == $cargo){
									echo " selected";
								}
								echo ">" . $currentCargo -> getN_cargo() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
