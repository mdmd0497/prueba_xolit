<?php
$processed=false;
$n_area="";
if(isset($_POST['n_area'])){
	$n_area=$_POST['n_area'];
}
$empleado="";
if(isset($_POST['empleado'])){
	$empleado=$_POST['empleado'];
}
if(isset($_GET['idEmpleado'])){
	$empleado=$_GET['idEmpleado'];
}
if(isset($_POST['insert'])){
	$newAreas = new Areas("", $n_area, $empleado);
	$newAreas -> insert();
	$objEmpleado = new Empleado($empleado);
	$objEmpleado -> select();
	$nameEmpleado = $objEmpleado -> getNombre() . " " . $objEmpleado -> getApellido() ;
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
		$logAdministrador = new LogAdministrador("","Crear Areas", "N_area: " . $n_area . "; Empleado: " . $nameEmpleado , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Empleado'){
		$logEmpleado = new LogEmpleado("","Crear Areas", "N_area: " . $n_area . "; Empleado: " . $nameEmpleado , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Areas</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/areas/insertAreas.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>N_area*</label>
							<input type="text" class="form-control" name="n_area" value="<?php echo $n_area ?>" required />
						</div>
					<div class="form-group">
						<label>Empleado*</label>
						<select class="form-control" name="empleado">
							<?php
							$objEmpleado = new Empleado();
							$empleados = $objEmpleado -> selectAllOrder("nombre", "asc");
							foreach($empleados as $currentEmpleado){
								echo "<option value='" . $currentEmpleado -> getIdEmpleado() . "'";
								if($currentEmpleado -> getIdEmpleado() == $empleado){
									echo " selected";
								}
								echo ">" . $currentEmpleado -> getNombre() . " " . $currentEmpleado -> getApellido() . "</option>";
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
