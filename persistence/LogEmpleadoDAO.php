<?php
class LogEmpleadoDAO{
	private $idLogEmpleado;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $empleado;

	function LogEmpleadoDAO($pIdLogEmpleado = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pEmpleado = ""){
		$this -> idLogEmpleado = $pIdLogEmpleado;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> empleado = $pEmpleado;
	}

	function insert(){
		return "insert into LogEmpleado(accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> empleado . "')";
	}

	function update(){
		return "update LogEmpleado set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				empleado_idEmpleado = '" . $this -> empleado . "'	
				where idLogEmpleado = '" . $this -> idLogEmpleado . "'";
	}

	function select() {
		return "select idLogEmpleado, accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado
				from LogEmpleado
				where idLogEmpleado = '" . $this -> idLogEmpleado . "'";
	}

	function selectAll() {
		return "select idLogEmpleado, accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado
				from LogEmpleado";
	}

	function selectAllByEmpleado() {
		return "select idLogEmpleado, accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado
				from LogEmpleado
				where empleado_idEmpleado = '" . $this -> empleado . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogEmpleado, accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado
				from LogEmpleado
				order by " . $orden . " " . $dir;
	}

	function selectAllByEmpleadoOrder($orden, $dir) {
		return "select idLogEmpleado, accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado
				from LogEmpleado
				where empleado_idEmpleado = '" . $this -> empleado . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogEmpleado, accion, informacion, fecha, hora, ip, so, explorador, empleado_idEmpleado
				from LogEmpleado
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by fecha desc, hora desc";
	}
}
?>
