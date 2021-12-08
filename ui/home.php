<?php
$logInError=false;
$enabledError=false;
if(isset($_POST['logIn'])){
	if(isset($_POST['email']) && isset($_POST['password'])){
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
		$email=$_POST['email'];
		$password=$_POST['password'];
		$administrador = new Administrador();
		if($administrador -> logIn($email, $password)){
			if($administrador -> getEstado()==1){
				$_SESSION['id']=$administrador -> getIdAdministrador();
				$_SESSION['entity']="Administrador";
				$logAdministrador = new LogAdministrador("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $administrador -> getIdAdministrador());
				$logAdministrador -> insert();
				echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionAdministrador.php") . "'</script>"; 
			} else { 
				$enabledError=true; 
			}
		}
		$empleado = new Empleado();
		if($empleado -> logIn($email, $password)){
			if($empleado -> getEstado()==1){
				$_SESSION['id']=$empleado -> getIdEmpleado();
				$_SESSION['entity']="Empleado";
				$logEmpleado = new LogEmpleado("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $empleado -> getIdEmpleado());
				$logEmpleado -> insert();
				echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionEmpleado.php") . "'</script>"; 
			} else { 
				$enabledError=true; 
			}
		}
		$logInError=true;
	}
}
?>
<div align="center">
	<?php include("ui/header.php"); ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h4><strong>empresa</strong></h4>
				</div>
				<div class="card-body">
					<p>Existe una empresa, la cual tiene varias Areas y cada Area tiene empleados con diferentes cargos.</p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h4><strong>Autenticar</strong></h4>
				</div>
				<div class="card-body">
					<form id="form" method="post" action="index.php" class="bootstrap-form needs-validation"  >
						<div class="form-group">
							<div class="input-group" >
								<input type="email" class="form-control" name="email" placeholder="Correo" autocomplete="off" required />
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Clave" required />
						</div>
						<?php if($enabledError){
							echo "<div class='alert alert-danger' >Usuario Deshabilitado</div>";
						} else if ($logInError){
							echo "<div class='alert alert-danger' >Error de correo o clave</div>";
						} ?>
						<div class="form-group">
							<a href="index.php?pid=<?php echo base64_encode("ui/recoverPassword.php") ?>">Recuperar Clave</a>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info" name="logIn">Autenticar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
