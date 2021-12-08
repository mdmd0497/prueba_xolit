<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nombre</th>
			<th nowrap>Apellido</th>
			<th nowrap>Correo</th>
			<th nowrap>State</th>
			<th>Cargo</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$empleado = new Empleado();
		$empleados = $empleado -> search($_GET['search']);
		$counter = 1;
		foreach ($empleados as $currentEmpleado) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEmpleado -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEmpleado -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEmpleado -> getCorreo()) . "</td>";
						echo "<td>" . ($currentEmpleado -> getState()==1?"Habilitado":"Deshabilitado") . "</td>";
			echo "<td>" . $currentEmpleado -> getCargo() -> getN_cargo() . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalEmpleado.php?idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'  data-toggle='modal' data-target='#modalEmpleado' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/empleado/updateEmpleado.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Empleado' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/empleado/updateFotoEmpleado.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "&attribute=foto'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar foto'></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/areas/selectAllAreasByEmpleado.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Areas' ></span></a> ";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areas/insertAreas.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Areas' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
