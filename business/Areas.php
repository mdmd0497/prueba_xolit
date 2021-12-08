<?php
require_once ("persistence/AreasDAO.php");
require_once ("persistence/Connection.php");

class Areas {
	private $idAreas;
	private $n_area;
	private $empleado;
	private $areasDAO;
	private $connection;

	function getIdAreas() {
		return $this -> idAreas;
	}

	function setIdAreas($pIdAreas) {
		$this -> idAreas = $pIdAreas;
	}

	function getN_area() {
		return $this -> n_area;
	}

	function setN_area($pN_area) {
		$this -> n_area = $pN_area;
	}

	function getEmpleado() {
		return $this -> empleado;
	}

	function setEmpleado($pEmpleado) {
		$this -> empleado = $pEmpleado;
	}

	function Areas($pIdAreas = "", $pN_area = "", $pEmpleado = ""){
		$this -> idAreas = $pIdAreas;
		$this -> n_area = $pN_area;
		$this -> empleado = $pEmpleado;
		$this -> areasDAO = new AreasDAO($this -> idAreas, $this -> n_area, $this -> empleado);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idAreas = $result[0];
		$this -> n_area = $result[1];
		$empleado = new Empleado($result[2]);
		$empleado -> select();
		$this -> empleado = $empleado;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> selectAll());
		$areass = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[2]);
			$empleado -> select();
			array_push($areass, new Areas($result[0], $result[1], $empleado));
		}
		$this -> connection -> close();
		return $areass;
	}

	function selectAllByEmpleado(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> selectAllByEmpleado());
		$areass = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[2]);
			$empleado -> select();
			array_push($areass, new Areas($result[0], $result[1], $empleado));
		}
		$this -> connection -> close();
		return $areass;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> selectAllOrder($order, $dir));
		$areass = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[2]);
			$empleado -> select();
			array_push($areass, new Areas($result[0], $result[1], $empleado));
		}
		$this -> connection -> close();
		return $areass;
	}

	function selectAllByEmpleadoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> selectAllByEmpleadoOrder($order, $dir));
		$areass = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[2]);
			$empleado -> select();
			array_push($areass, new Areas($result[0], $result[1], $empleado));
		}
		$this -> connection -> close();
		return $areass;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> search($search));
		$areass = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[2]);
			$empleado -> select();
			array_push($areass, new Areas($result[0], $result[1], $empleado));
		}
		$this -> connection -> close();
		return $areass;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areasDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
