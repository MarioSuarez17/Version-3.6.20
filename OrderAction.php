<?php
	session_start();
	require 'Connection.php';
	$PlatilloID = $_GET["PlatilloID"];
	$CustomerID = $_GET["CustomerID"];
	$Estado = $_POST["Estado"];
	//$Espeficacion = $_POST["especificacion"];
	$DateOrder = date("Y/m/d");

	
	if($_SESSION['Username'] == null || $_SESSION['Password'] == null)
	{
		echo "<script>window.open('Login.php?Role=User','_self',null,true); window.alert('Please Login to Process your order');</script>";
	}
	
	$sql2 = "INSERT INTO tbl_orden(productoID,usuarioID,estado,fecha) ".
			"VALUES ($PlatilloID,$CustomerID,'$Estado',$DateOrder)"; //'$Espeficacion',
	$res2 = sqlsrv_query($Conn,$sql2);
	if($res2){
		echo "<script>window.alert('Success'); window.open('index.php','_self',null,true);</script>";
	}
?>