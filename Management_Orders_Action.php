<?php

//reload() Probar 
	require 'Connection.php';
    $ID = $_GET["id"];
    
	$sql = "UPDATE tbl_orden SET estado = 'Cancelado' where ordenID = $ID";
    
    $res = sqlsrv_query($Conn,$sql);
	if($res){
		echo '<script>window.open("Management_Orders.php","_self",null,true);</script>';
	}
	
?>