<?php
class AreasDAO{
	private $idAreas;
	private $n_area;
	private $empleado;

	function AreasDAO($pIdAreas = "", $pN_area = "", $pEmpleado = ""){
		$this -> idAreas = $pIdAreas;
		$this -> n_area = $pN_area;
		$this -> empleado = $pEmpleado;
	}

	function insert(){
		return "insert into Areas(n_area, empleado_idEmpleado)
				values('" . $this -> n_area . "', '" . $this -> empleado . "')";
	}

	function update(){
		return "update Areas set 
				n_area = '" . $this -> n_area . "',
				empleado_idEmpleado = '" . $this -> empleado . "'	
				where idAreas = '" . $this -> idAreas . "'";
	}

	function select() {
		return "select idAreas, n_area, empleado_idEmpleado
				from Areas
				where idAreas = '" . $this -> idAreas . "'";
	}

	function selectAll() {
		return "select idAreas, n_area, empleado_idEmpleado
				from Areas";
	}

	function selectAllByEmpleado() {
		return "select idAreas, n_area, empleado_idEmpleado
				from Areas
				where empleado_idEmpleado = '" . $this -> empleado . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idAreas, n_area, empleado_idEmpleado
				from Areas
				order by " . $orden . " " . $dir;
	}

	function selectAllByEmpleadoOrder($orden, $dir) {
		return "select idAreas, n_area, empleado_idEmpleado
				from Areas
				where empleado_idEmpleado = '" . $this -> empleado . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idAreas, n_area, empleado_idEmpleado
				from Areas
				where n_area like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Areas
				where idAreas = '" . $this -> idAreas . "'";
	}
}
?>
