<?php
	session_start();
	require 'Connection.php';
    //$ID = $_GET["ordenID"];
	
	$_ordenID = $_GET["ordenID"];
	// Se crean los parámetros
	$myparams['ordenID'] = $_ordenID;

	$procedure_params = array(
		array(&$myparams['ordenID'], SQLSRV_PARAM_IN),
	);
	$sql = "sp_update_orders_completo @ID =?";
	$stmt = sqlsrv_prepare($Conn, $sql,$procedure_params);
		if(sqlsrv_execute($stmt))
		{
			echo '<script>window.alert("The order has been updated successfully!"); window.open("Management_Orders.php","_self",null,true)</script>';
		}
?>