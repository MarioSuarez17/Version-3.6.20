

<?php

	session_start();
	$ProductAction = $_GET["ProductAction"];
	
	require 'Connection.php';
	
	//ACCIONES 
	if($ProductAction == "Add")
	{
		$_PlatilloName = $_POST["PlatilloName"];
		$_ProductDescript = $_POST["PlatilloDescript"];
		$_PlatilloPrice = $_POST["PlatilloPrice"];
		$_ProductCatidad = $_POST["PlatilloQuantity"];
		
		$_Estado = $_POST["Estado"];
		
		$image = addslashes($_FILES['ProductImage']['tmp_name']);
		$name = addslashes($_FILES['ProductImage']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
		$_CategoriaID = $_POST["CategoriaID"];
		
		$sql = "INSERT INTO tbl_producto(nombre,descripcion,precio,cantidad,imageNombre,imagen,estado,categoriaID)" . 
		"VALUES ('$_PlatilloName','$_ProductDescript','$_PlatilloPrice',$_ProductCatidad,'$name','$image','$_Estado',$_CategoriaID)";   //,
		$res = sqlsrv_query($Conn,$sql);
		if($res)
		{
			echo '<script>window.alert("Product has been successfully created!"),window.open("Management_ProductsList.php","_self",null,true);</script>';
			     
		}
		else
		{
			echo '<script>alert("FAILED!"); window.open("Management_Products.php","_self",null,true)</script>';

		}  //Evalua la accion 
	}else if($ProductAction == "Edit")
	{
		$_PlatilloName = $_POST["PlatilloName"];
		$_ProductDescript = $_POST["PlatilloDescript"];
		$_PlatilloPrice = $_POST["PlatilloPrice"];
		$_ProductCatidad = $_POST["PlatilloQuantity"];
		//$_Estado = $_POST["Estado"];
		$_CategoriaID = $_POST["CategoriaID"];
		

		$image = addslashes($_FILES['ProductImage']['tmp_name']);
		$name = addslashes($_FILES['ProductImage']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
		//Toma el ID
		$_PlatilloID = $_GET["productoID"];
	
		if(empty($_FILES['ProductImage']['tmp_name'])){
			$sql = "UPDATE tbl_producto SET nombre='$_PlatilloName',descripcion='$_ProductDescript'," .
				   "precio=$_PlatilloPrice  WHERE productoID =  $_PlatilloID";
			$res = sqlsrv_query($Conn,$sql);
			if($res)
			{
				echo '<script>window.alert("Product has been successfully updated!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
			}
		}
		$sql = "UPDATE tbl_producto SET nombre='$_PlatilloName',descripcion='$_ProductDescript'," .
			   "precio=$_PlatilloPrice,cantidad=$_ProductCatidad,categoriaID=$_CategoriaID," .
			   "imageNombre='$name',imagen='$image' WHERE productoID = $_PlatilloID";
		$res = sqlsrv_query($Conn,$sql);
		if($res)
		{
			echo '<script>window.alert("Product has been successfully updated!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	}else if($ProductAction == "Delete")
	{//Ver para establer para cambiar de estado REVISAR
		$_PlatilloID = $_GET["productoID"];
		$sql = "UPDATE tbl_producto SET Estado = 'Inactivo' where productoID = $_PlatilloID"; //Cambiado por Inactivo
		$res = sqlsrv_query($Conn,$sql);
		if($res)
		{
			echo '<script>window.alert("Product has been successfully Deleted!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	}

?>













