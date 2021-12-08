<?php
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Areas.php");
require("business/Cargo.php");
require("business/LogEmpleado.php");
require("business/Empleado.php");
require_once("persistence/Connection.php");
$idAreas = $_GET ['idAreas'];
$areas = new Areas($idAreas);
$areas -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Areas</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>N_area</th>
			<td><?php echo $areas -> getN_area() ?></td>
		</tr>
		<tr>
			<th>Empleado</th>
			<td><?php echo $areas -> getEmpleado() -> getNombre() . " " . $areas -> getEmpleado() -> getApellido() ?></td>
		</tr>
	</table>
</div>
