<?php
require_once ("persistence/CargoDAO.php");
require_once ("persistence/Connection.php");

class Cargo {
	private $idCargo;
	private $n_cargo;
	private $cargoDAO;
	private $connection;

	function getIdCargo() {
		return $this -> idCargo;
	}

	function setIdCargo($pIdCargo) {
		$this -> idCargo = $pIdCargo;
	}

	function getN_cargo() {
		return $this -> n_cargo;
	}

	function setN_cargo($pN_cargo) {
		$this -> n_cargo = $pN_cargo;
	}

	function Cargo($pIdCargo = "", $pN_cargo = ""){
		$this -> idCargo = $pIdCargo;
		$this -> n_cargo = $pN_cargo;
		$this -> cargoDAO = new CargoDAO($this -> idCargo, $this -> n_cargo);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCargo = $result[0];
		$this -> n_cargo = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> selectAll());
		$cargos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cargos, new Cargo($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $cargos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> selectAllOrder($order, $dir));
		$cargos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cargos, new Cargo($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $cargos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> search($search));
		$cargos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cargos, new Cargo($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $cargos;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cargoDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
