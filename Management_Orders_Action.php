<?php

//reload() Probar 
	require 'Connection.php';
    $ID = $_GET["id"];
    
	//$sql = "UPDATE tbl_orders SET Estado = 'Cancelado' where OrderID = $ID";
	$sql = "sp_query_orden_Cancelar";
    
    $res = sqlsrv_query($Conn,$sql);
	if($res){
		echo '<script>window.open("Management_Orders.php","_self",null,true);</script>';
	}
	
?>