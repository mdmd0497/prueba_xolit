<?php
require_once ("persistence/LogEmpleadoDAO.php");
require_once ("persistence/Connection.php");

class LogEmpleado {
	private $idLogEmpleado;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $empleado;
	private $logEmpleadoDAO;
	private $connection;

	function getIdLogEmpleado() {
		return $this -> idLogEmpleado;
	}

	function setIdLogEmpleado($pIdLogEmpleado) {
		$this -> idLogEmpleado = $pIdLogEmpleado;
	}

	function getAccion() {
		return $this -> accion;
	}

	function setAccion($pAccion) {
		$this -> accion = $pAccion;
	}

	function getInformacion() {
		return $this -> informacion;
	}

	function setInformacion($pInformacion) {
		$this -> informacion = $pInformacion;
	}

	function getFecha() {
		return $this -> fecha;
	}

	function setFecha($pFecha) {
		$this -> fecha = $pFecha;
	}

	function getHora() {
		return $this -> hora;
	}

	function setHora($pHora) {
		$this -> hora = $pHora;
	}

	function getIp() {
		return $this -> ip;
	}

	function setIp($pIp) {
		$this -> ip = $pIp;
	}

	function getSo() {
		return $this -> so;
	}

	function setSo($pSo) {
		$this -> so = $pSo;
	}

	function getExplorador() {
		return $this -> explorador;
	}

	function setExplorador($pExplorador) {
		$this -> explorador = $pExplorador;
	}

	function getEmpleado() {
		return $this -> empleado;
	}

	function setEmpleado($pEmpleado) {
		$this -> empleado = $pEmpleado;
	}

	function LogEmpleado($pIdLogEmpleado = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pEmpleado = ""){
		$this -> idLogEmpleado = $pIdLogEmpleado;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> empleado = $pEmpleado;
		$this -> logEmpleadoDAO = new LogEmpleadoDAO($this -> idLogEmpleado, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> empleado);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogEmpleado = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$empleado = new Empleado($result[8]);
		$empleado -> select();
		$this -> empleado = $empleado;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> selectAll());
		$logEmpleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[8]);
			$empleado -> select();
			array_push($logEmpleados, new LogEmpleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $empleado));
		}
		$this -> connection -> close();
		return $logEmpleados;
	}

	function selectAllByEmpleado(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> selectAllByEmpleado());
		$logEmpleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[8]);
			$empleado -> select();
			array_push($logEmpleados, new LogEmpleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $empleado));
		}
		$this -> connection -> close();
		return $logEmpleados;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> selectAllOrder($order, $dir));
		$logEmpleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[8]);
			$empleado -> select();
			array_push($logEmpleados, new LogEmpleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $empleado));
		}
		$this -> connection -> close();
		return $logEmpleados;
	}

	function selectAllByEmpleadoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> selectAllByEmpleadoOrder($order, $dir));
		$logEmpleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[8]);
			$empleado -> select();
			array_push($logEmpleados, new LogEmpleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $empleado));
		}
		$this -> connection -> close();
		return $logEmpleados;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEmpleadoDAO -> search($search));
		$logEmpleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$empleado = new Empleado($result[8]);
			$empleado -> select();
			array_push($logEmpleados, new LogEmpleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $empleado));
		}
		$this -> connection -> close();
		return $logEmpleados;
	}
}
?>
