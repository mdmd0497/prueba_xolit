<?php 
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Areas.php");
require("business/Cargo.php");
require("business/LogEmpleado.php");
require("business/Empleado.php");
$pid=base64_decode($_GET['pid']);
include($pid);
?>
