<?php
class EmpleadoDAO{
	private $idEmpleado;
	private $nombre;
	private $apellido;
	private $correo;
	private $clave;
	private $foto;
	private $state;
	private $cargo;

	function EmpleadoDAO($pIdEmpleado = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pState = "", $pCargo = ""){
		$this -> idEmpleado = $pIdEmpleado;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> correo = $pCorreo;
		$this -> clave = $pClave;
		$this -> foto = $pFoto;
		$this -> state = $pState;
		$this -> cargo = $pCargo;
	}

	function logIn($correo, $clave){
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				where correo = '" . $correo . "' and clave = '" . md5($clave) . "'";
	}

	function insert(){
		return "insert into Empleado(nombre, apellido, correo, clave, foto, state, cargo_idCargo)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', md5('" . $this -> clave . "'), '" . $this -> foto . "', '" . $this -> state . "', '" . $this -> cargo . "')";
	}

	function update(){
		return "update Empleado set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				correo = '" . $this -> correo . "',
				state = '" . $this -> state . "',
				cargo_idCargo = '" . $this -> cargo . "'	
				where idEmpleado = '" . $this -> idEmpleado . "'";
	}

	function updateClave($password){
		return "update Empleado set 
				clave = '" . md5($password) . "'
				where idEmpleado = '" . $this -> idEmpleado . "'";
	}

	function existEmail($email){
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Empleado set 
				clave = '" . md5($password) . "'
				where correo = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Empleado set "
				. $attribute . " = '" . $value . "'
				where idEmpleado = '" . $this -> idEmpleado . "'";
	}

	function select() {
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				where idEmpleado = '" . $this -> idEmpleado . "'";
	}

	function selectAll() {
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado";
	}

	function selectAllByCargo() {
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				where cargo_idCargo = '" . $this -> cargo . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				order by " . $orden . " " . $dir;
	}

	function selectAllByCargoOrder($orden, $dir) {
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				where cargo_idCargo = '" . $this -> cargo . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idEmpleado, nombre, apellido, correo, clave, foto, state, cargo_idCargo
				from Empleado
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or correo like '%" . $search . "%' or state like '%" . $search . "%'";
	}
}
?>
