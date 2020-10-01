<?php

//reload() Probar 
	session_start();
	require 'Connection.php';
    //$ID = $_GET["id"];
    //$sql = "UPDATE tbl_orders SET Estado = 'Cancelado' where OrderID = $ID";
	//$sql = "sp_query_orden_Cancelar";
    //$res = sqlsrv_query($Conn,$sql);
	
	$_OrderID = $_GET["ordenID"];
	// Se crean los parámetros
	$myparams['ordenID'] = $_OrderID;
	
	//Se crea un array con de parámetros
	$procedure_params = array(
		array(&$myparams['ordenID'], SQLSRV_PARAM_IN)		
	);

	$sql = "sp_query_orden_Cancelar @ordenID=?,@estado='Cancelada'";
	$stmt = sqlsrv_prepare($Conn, $sql,$procedure_params);

	if(sqlsrv_execute($stmt))

	//if($res)
	{
		echo '<script>window.alert("Orden Cancelada!");<script>window.open("Management_Orders.php","_self",null,true);</script>';
	}
	
?>