<?php
	session_start();
	$OrderAction = $_GET["OrderAction"];
	require 'Connection.php';
	//ACCIONES 
	if($OrderAction == "Cancelar"){
	$_ordenID = $_GET["ordenID"];
	$myparams['ordenID'] = $_ordenID;
	$procedure_params = array(
		array(&$myparams['ordenID'], SQLSRV_PARAM_IN));
	$sql = "sp_update_orders_cancelado @ID =?";
	$stmt = sqlsrv_prepare($Conn, $sql,$procedure_params);
		if(sqlsrv_execute($stmt))
		{
			echo '<script>window.alert("The order has been updated successfully!"); window.open("Management_Orders.php","_self",null,true)</script>';
		}
	}elseif($OrderAction == "Completo"){
		$_ordenID = $_GET["ordenID"];
		$myparams['ordenID'] = $_ordenID;
		$procedure_params = array(array(&$myparams['ordenID'], SQLSRV_PARAM_IN));
		$sql = "sp_update_orders_completo @ID =?";
		$stmt = sqlsrv_prepare($Conn, $sql,$procedure_params);
			if(sqlsrv_execute($stmt))
			{
				echo '<script>window.alert("The order has been updated successfully!"); window.open("Management_Orders.php","_self",null,true)</script>';
			}
	}
?>