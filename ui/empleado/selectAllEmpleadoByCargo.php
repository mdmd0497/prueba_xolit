<?php
$order = "apellido";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "asc";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$cargo = new Cargo($_GET['idCargo']); 
$cargo -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Empleado de Cargo: <em><?php echo $cargo -> getN_cargo() ?></em></h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if($order=="apellido" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=apellido&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="apellido" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=apellido&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if($order=="correo" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=correo&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="correo" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=correo&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>State 
						<?php if($order=="state" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=state&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="state" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/empleado/selectAllEmpleadoByCargo.php") ?>&idCargo=<?php echo $_GET['idCargo'] ?>&order=state&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Cargo</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$empleado = new Empleado("", "", "", "", "", "", "", $_GET['idCargo']);
					if($order!="" && $dir!="") {
						$empleados = $empleado -> selectAllByCargoOrder($order, $dir);
					} else {
						$empleados = $empleado -> selectAllByCargo();
					}
					$counter = 1;
					foreach ($empleados as $currentEmpleado) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentEmpleado -> getNombre() . "</td>";
						echo "<td>" . $currentEmpleado -> getApellido() . "</td>";
						echo "<td>" . $currentEmpleado -> getCorreo() . "</td>";
						echo "<td>" . ($currentEmpleado -> getState()==1?"Habilitado":"Deshabilitado") . "</td>";
						echo "<td><a href='modalCargo.php?idCargo=" . $currentEmpleado -> getCargo() -> getIdCargo() . "' data-toggle='modal' data-target='#modalEmpleado' >" . $currentEmpleado -> getCargo() -> getN_cargo() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalEmpleado.php?idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'  data-toggle='modal' data-target='#modalEmpleado' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/empleado/updateEmpleado.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Empleado' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/empleado/updateFotoEmpleado.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "&attribute=foto'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar foto'></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/areas/selectAllAreasByEmpleado.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Areas' ></span></a> ";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areas/insertAreas.php") . "&idEmpleado=" . $currentEmpleado -> getIdEmpleado() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Areas' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
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
