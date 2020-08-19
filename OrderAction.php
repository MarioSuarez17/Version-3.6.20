<?php
	session_start();
	require 'Connection.php';
	$PlatilloID = $_GET['PlatilloID'];
	$CustomerID = $_GET['CustomerID'];
	$Estado = $_POST['Estado'];
	$Espeficacion = $_POST['Espeficacion'];
	$DateOrder = date("Y/m/d");
	
	if($_SESSION['Username'] == null || $_SESSION['Password'] == null)
	{
		echo "<script>window.open('Login.php?Role=User','_self',null,true); window.alert('Please Login to Process your order');</script>";
	}
	
	$sql2 = "INSERT INTO `tbl_orders`(`PlatilloID`, `CustomerID`,`Estado`, `Especificacion`, `DateOrdered`) ".
			"VALUES ('$PlatilloID','$CustomerID','$Estado','$Espeficacion','$DateOrder')";
	$res2 = mysqli_query($Conn,$sql2);
	if($res2){
		echo "<script>window.alert('Success'); window.open('index.php','_self',null,true);</script>";
	}
?>