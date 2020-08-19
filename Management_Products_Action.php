

<?php

	session_start();
	$ProductAction = $_GET["ProductAction"];
	
	require 'Connection.php';
	
	//ACCIONES 
	if($ProductAction == "Add")
	{
		$_PlatilloName = $_POST["PlatilloName"];
		$_PlatilloPrice = $_POST["PlatilloPrice"];
		$_ProductDescript = $_POST["PlatilloDescript"];
		$_Estado = $_POST["Estado"];

		$image = addslashes($_FILES['ProductImage']['tmp_name']);
		$name = addslashes($_FILES['ProductImage']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
		
		$sql = "INSERT INTO `tbl_platillos`(`Platilloname`,`PlatilloDescript`,`PlatilloPrice`, `PlatilloImageName`, `PlatilloImage`, `Estado` )" . 
		"VALUES ('$_PlatilloName','$_ProductDescript','$_PlatilloPrice','$name','$image','$_Estado')";
		$res = mysqli_query($Conn,$sql);
		if($res)
		{
			echo '<script>window.open("Management_ProductsList.php","_self",null,true);</script>';
		}
		else
		{
			echo '<script>alert("FAILED!")</script>';
		}  //Evalua la accion 
	}else if($ProductAction == "Edit")
	{
		$_PlatilloName = $_POST["PlatilloName"];
		$_PlatilloPrice = $_POST["PlatilloPrice"];
		$_PlatilloDescript = $_POST["PlatilloDescript"];
		

		$image = addslashes($_FILES['ProductImage']['tmp_name']);
		$name = addslashes($_FILES['ProductImage']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
		//Toma el ID
		$_PlatilloID = $_GET["PlatilloID"];
	
		if(empty($_FILES['ProductImage']['tmp_name'])){
			$sql = "UPDATE `tbl_platillos` SET `Platilloname`='$_PlatilloName',`PlatilloDescript`='$_PlatilloDescript'," .
				   "`PlatilloPrice`='$_PlatilloPrice' WHERE `PlatilloID` =  $_PlatilloID";
			$res = mysqli_query($Conn,$sql);
			if($res)
			{
				echo '<script>window.alert("Product has been successfully updated!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
			}
		}
		$sql = "UPDATE `tbl_platillos` SET `Platilloname`='$_PlatilloName',`PlatilloDescript`='$_PlatilloDescript'," .
			   "`PlatilloPrice`='$_PlatilloPrice'," .
			   "`PlatilloImageName`='$name',`PlatilloImage`='$image' WHERE `PlatilloID` = $_PlatilloID";
		$res = mysqli_query($Conn,$sql);
		if($res)
		{
			echo '<script>window.alert("Product has been successfully updated!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	}else if($ProductAction == "Delete")
	{//Ver para establer para cambiar de estado REVISAR
		$_PlatilloID = $_GET["ProdID"];
		$sql = "UPDATE tbl_platillos SET Estado = 'Desactivo' where PlatilloID = $_PlatilloID";
		$res = mysqli_query($Conn,$sql);
		if($res)
		{
			echo '<script>window.alert("Product has been successfully Deleted!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	}

?>













