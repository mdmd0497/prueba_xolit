<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$empleado = new Empleado($_GET['idEmpleado']); 
$empleado -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteAreas = new Areas($_GET['idAreas']);
	$deleteAreas -> select();
	if($deleteAreas -> delete()){
		$nameEmpleado = $deleteAreas -> getEmpleado() -> getNombre() . " " . $deleteAreas -> getEmpleado() -> getApellido();
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
			$logAdministrador = new LogAdministrador("","Delete Areas", "N_area: " . $deleteAreas -> getN_area() . ";; Empleado: " . $nameEmpleado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Empleado'){
			$logEmpleado = new LogEmpleado("","Delete Areas", "N_area: " . $deleteAreas -> getN_area() . ";; Empleado: " . $nameEmpleado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEmpleado -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Areas de Empleado: <em><?php echo $empleado -> getNombre() . " " . $empleado -> getApellido() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>N_area 
						<?php if($order=="n_area" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/areas/selectAllAreasByEmpleado.php") ?>&idEmpleado=<?php echo $_GET['idEmpleado'] ?>&order=n_area&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="n_area" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/areas/selectAllAreasByEmpleado.php") ?>&idEmpleado=<?php echo $_GET['idEmpleado'] ?>&order=n_area&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Empleado</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$areas = new Areas("", "", $_GET['idEmpleado']);
					if($order!="" && $dir!="") {
						$areass = $areas -> selectAllByEmpleadoOrder($order, $dir);
					} else {
						$areass = $areas -> selectAllByEmpleado();
					}
					$counter = 1;
					foreach ($areass as $currentAreas) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentAreas -> getN_area() . "</td>";
						echo "<td><a href='modalEmpleado.php?idEmpleado=" . $currentAreas -> getEmpleado() -> getIdEmpleado() . "' data-toggle='modal' data-target='#modalAreas' >" . $currentAreas -> getEmpleado() -> getNombre() . " " . $currentAreas -> getEmpleado() -> getApellido() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areas/updateAreas.php") . "&idAreas=" . $currentAreas -> getIdAreas() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Areas' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areas/selectAllAreasByEmpleado.php") . "&idEmpleado=" . $_GET['idEmpleado'] . "&idAreas=" . $currentAreas -> getIdAreas() . "&action=delete' onclick='return confirm(\"Confirm to delete Areas: " . $currentAreas -> getN_area() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Areas' ></span></a> ";
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
<div class="modal fade" id="modalAreas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
