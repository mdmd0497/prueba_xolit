<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>N_area</th>
			<th>Empleado</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$areas = new Areas();
		$areass = $areas -> search($_GET['search']);
		$counter = 1;
		foreach ($areass as $currentAreas) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAreas -> getN_area()) . "</td>";
			echo "<td>" . $currentAreas -> getEmpleado() -> getNombre() . " " . $currentAreas -> getEmpleado() -> getApellido() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areas/updateAreas.php") . "&idAreas=" . $currentAreas -> getIdAreas() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Areas' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areas/selectAllAreas.php") . "&idAreas=" . $currentAreas -> getIdAreas() . "&action=delete' onclick='return confirm(\"Confirm to delete Areas: " . $currentAreas -> getN_area() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Areas' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
