<?php
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Areas.php");
require("business/Cargo.php");
require("business/LogEmpleado.php");
require("business/Empleado.php");
require_once("persistence/Connection.php");
$idCargo = $_GET ['idCargo'];
$cargo = new Cargo($idCargo);
$cargo -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Cargo</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>N_cargo</th>
			<td><?php echo $cargo -> getN_cargo() ?></td>
		</tr>
	</table>
</div>
