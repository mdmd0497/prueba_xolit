<?php
require_once ("persistence/EmpleadoDAO.php");
require_once ("persistence/Connection.php");

class Empleado {
	private $idEmpleado;
	private $nombre;
	private $apellido;
	private $correo;
	private $clave;
	private $foto;
	private $state;
	private $cargo;
	private $empleadoDAO;
	private $connection;

	function getIdEmpleado() {
		return $this -> idEmpleado;
	}

	function setIdEmpleado($pIdEmpleado) {
		$this -> idEmpleado = $pIdEmpleado;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getApellido() {
		return $this -> apellido;
	}

	function setApellido($pApellido) {
		$this -> apellido = $pApellido;
	}

	function getCorreo() {
		return $this -> correo;
	}

	function setCorreo($pCorreo) {
		$this -> correo = $pCorreo;
	}

	function getClave() {
		return $this -> clave;
	}

	function setClave($pClave) {
		$this -> clave = $pClave;
	}

	function getFoto() {
		return $this -> foto;
	}

	function setFoto($pFoto) {
		$this -> foto = $pFoto;
	}

	function getState() {
		return $this -> state;
	}

	function setState($pState) {
		$this -> state = $pState;
	}

	function getCargo() {
		return $this -> cargo;
	}

	function setCargo($pCargo) {
		$this -> cargo = $pCargo;
	}

	function Empleado($pIdEmpleado = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pState = "", $pCargo = ""){
		$this -> idEmpleado = $pIdEmpleado;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> correo = $pCorreo;
		$this -> clave = $pClave;
		$this -> foto = $pFoto;
		$this -> state = $pState;
		$this -> cargo = $pCargo;
		$this -> empleadoDAO = new EmpleadoDAO($this -> idEmpleado, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> state, $this -> cargo);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idEmpleado = $result[0];
			$this -> nombre = $result[1];
			$this -> apellido = $result[2];
			$this -> correo = $result[3];
			$this -> clave = $result[4];
			$this -> foto = $result[5];
			$this -> state = $result[6];
			$cargo = new Cargo($result[7]);
			$cargo -> select();
			$this -> cargo = $cargo;
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> update());
		$this -> connection -> close();
	}

	function updateClave($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> updateClave($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> existEmail($email));
		if($this -> connection -> numRows()==1){
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function recoverPassword($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idEmpleado = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> correo = $result[3];
		$this -> clave = $result[4];
		$this -> foto = $result[5];
		$this -> state = $result[6];
		$cargo = new Cargo($result[7]);
		$cargo -> select();
		$this -> cargo = $cargo;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> selectAll());
		$empleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$cargo = new Cargo($result[7]);
			$cargo -> select();
			array_push($empleados, new Empleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $cargo));
		}
		$this -> connection -> close();
		return $empleados;
	}

	function selectAllByCargo(){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> selectAllByCargo());
		$empleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$cargo = new Cargo($result[7]);
			$cargo -> select();
			array_push($empleados, new Empleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $cargo));
		}
		$this -> connection -> close();
		return $empleados;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> selectAllOrder($order, $dir));
		$empleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$cargo = new Cargo($result[7]);
			$cargo -> select();
			array_push($empleados, new Empleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $cargo));
		}
		$this -> connection -> close();
		return $empleados;
	}

	function selectAllByCargoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> selectAllByCargoOrder($order, $dir));
		$empleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$cargo = new Cargo($result[7]);
			$cargo -> select();
			array_push($empleados, new Empleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $cargo));
		}
		$this -> connection -> close();
		return $empleados;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> empleadoDAO -> search($search));
		$empleados = array();
		while ($result = $this -> connection -> fetchRow()){
			$cargo = new Cargo($result[7]);
			$cargo -> select();
			array_push($empleados, new Empleado($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $cargo));
		}
		$this -> connection -> close();
		return $empleados;
	}
}
?>
