<?php
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Areas.php");
require("business/Cargo.php");
require("business/LogEmpleado.php");
require("business/Empleado.php");
require_once("persistence/Connection.php");
$idEmpleado = $_GET ['idEmpleado'];
$empleado = new Empleado($idEmpleado);
$empleado -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Empleado</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $empleado -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Apellido</th>
			<td><?php echo $empleado -> getApellido() ?></td>
		</tr>
		<tr>
			<th>Correo</th>
			<td><?php echo $empleado -> getCorreo() ?></td>
		</tr>
		<tr>
			<th>Foto</th>
				<td><img class="rounded" src="<?php echo $empleado -> getFoto() ?>" height="300px" /></td>
		</tr>
		<tr>
			<th>State</th>
			<td><?php echo ($empleado -> getState()==1?"Habilitado":"Deshabilitado") ?> </td>
		</tr>
		<tr>
			<th>Cargo</th>
			<td><?php echo $empleado -> getCargo() -> getN_cargo() ?></td>
		</tr>
	</table>
</div>
