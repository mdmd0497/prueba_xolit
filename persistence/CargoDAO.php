<?php
class CargoDAO{
	private $idCargo;
	private $n_cargo;

	function CargoDAO($pIdCargo = "", $pN_cargo = ""){
		$this -> idCargo = $pIdCargo;
		$this -> n_cargo = $pN_cargo;
	}

	function insert(){
		return "insert into Cargo(n_cargo)
				values('" . $this -> n_cargo . "')";
	}

	function update(){
		return "update Cargo set 
				n_cargo = '" . $this -> n_cargo . "'	
				where idCargo = '" . $this -> idCargo . "'";
	}

	function select() {
		return "select idCargo, n_cargo
				from Cargo
				where idCargo = '" . $this -> idCargo . "'";
	}

	function selectAll() {
		return "select idCargo, n_cargo
				from Cargo";
	}

	function selectAllOrder($orden, $dir){
		return "select idCargo, n_cargo
				from Cargo
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCargo, n_cargo
				from Cargo
				where n_cargo like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Cargo
				where idCargo = '" . $this -> idCargo . "'";
	}
}
?>
