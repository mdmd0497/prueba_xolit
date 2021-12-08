<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>N_cargo</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$cargo = new Cargo();
		$cargos = $cargo -> search($_GET['search']);
		$counter = 1;
		foreach ($cargos as $currentCargo) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCargo -> getN_cargo()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cargo/updateCargo.php") . "&idCargo=" . $currentCargo -> getIdCargo() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cargo' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cargo/selectAllCargo.php") . "&idCargo=" . $currentCargo -> getIdCargo() . "&action=delete' onclick='return confirm(\"Confirm to delete Cargo: " . $currentCargo -> getN_cargo() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Cargo' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
