<?php
$processed=false;
$updateEmpleado = new Empleado($_SESSION['id']);
$updateEmpleado -> select();
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
$cargo="";
if(isset($_POST['cargo'])){
	$cargo=$_POST['cargo'];
}
if(isset($_POST['update'])){
	$updateEmpleado = new Empleado($_SESSION['id'], $nombre, $apellido, $correo, "", "", "1", $cargo);
	$updateEmpleado -> update();
	$updateEmpleado -> select();
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
	$logEmpleado = new LogEmpleado("","Editar Profile Empleado", "Nombre: " . $nombre . "; Apellido: " . $apellido . "; Correo: " . $correo . "; Cargo: " . $nameCargo , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
	$logEmpleado -> insert();
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Editar Profile Empleado</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/empleado/updateProfileEmpleado.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateEmpleado -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Apellido*</label>
							<input type="text" class="form-control" name="apellido" value="<?php echo $updateEmpleado -> getApellido() ?>" required />
						</div>
						<div class="form-group">
							<label>Correo*</label>
							<input type="email" class="form-control" name="correo" value="<?php echo $updateEmpleado -> getCorreo() ?>"  required />
						</div>
					<div class="form-group">
						<label>Cargo*</label>
						<select class="form-control" name="cargo">
							<?php
							$objCargo = new Cargo();
							$cargos = $objCargo -> selectAll();
							foreach($cargos as $currentCargo){
								echo "<option value='" . $currentCargo -> getIdCargo() . "'";
								if($currentCargo -> getIdCargo() == $updateEmpleado -> getCargo() -> getIdCargo()){
									echo " selected";
								}
								echo ">" . $currentCargo -> getN_cargo() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
