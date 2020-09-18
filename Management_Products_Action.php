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
		//VALUES (@nombre, @descripcion,@precio,@cantidad,@imageNombre,@imagen,@estado,@categoriaID) 
       // Se crean los parámetros
		$myparams['nombre'] = $_PlatilloName;
		$myparams['descripcion'] = $_ProductDescript;
		$myparams['precio'] = $_PlatilloPrice;
		$myparams['cantidad'] = $_ProductCatidad;
		$myparams['imageNombre'] = $name;
		$myparams['imagen'] = $image;
		$myparams['estado'] = $_Estado;
		$myparams['categoriaID'] = $_CategoriaID;
	
       //Se crea un array con de parámetros
		$procedure_params = array(
		array(&$myparams['nombre'], SQLSRV_PARAM_IN),
		array(&$myparams['descripcion'], SQLSRV_PARAM_IN),
		array(&$myparams['precio'], SQLSRV_PARAM_IN),
		array(&$myparams['cantidad'], SQLSRV_PARAM_IN),
		array(&$myparams['imageNombre'], SQLSRV_PARAM_IN),
		array(&$myparams['imagen'], SQLSRV_PARAM_IN),
		array(&$myparams['estado'], SQLSRV_PARAM_IN),
		array(&$myparams['categoriaID'], SQLSRV_PARAM_IN)
			
			);
			
			//Se se pasan los parámetros 
			$sql = "sp_insert_product @nombre = ?, 
			@descripcion = ?,@precio = ?,@cantidad = ?,@imageNombre = ?,
			@imagen = ?,@estado = ?,@categoriaID = ?";
			$stmt = sqlsrv_prepare($Conn, $sql, $procedure_params);

         // Se ejecuta y se evalua 
		if(sqlsrv_execute($stmt))
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

		// Se crean los parámetros
		$myparams['productoID'] = $_PlatilloID;
		$myparams['nombre'] = $_PlatilloName;
		$myparams['descripcion'] = $_ProductDescript;
		$myparams['precio'] = $_PlatilloPrice;
		$myparams['cantidad'] = $_ProductCatidad;
		$myparams['imageNombre'] = $name;
		$myparams['imagen'] = $image;
		$myparams['categoriaID'] = $_CategoriaID;

       //Se crea un array con de parámetros
		$procedure_params = array(
		array(&$myparams['productoID'], SQLSRV_PARAM_IN),
		array(&$myparams['nombre'], SQLSRV_PARAM_IN),
		array(&$myparams['descripcion'], SQLSRV_PARAM_IN),
		array(&$myparams['precio'], SQLSRV_PARAM_IN),
		array(&$myparams['cantidad'], SQLSRV_PARAM_IN),
		array(&$myparams['imageNombre'], SQLSRV_PARAM_IN),
		array(&$myparams['imagen'], SQLSRV_PARAM_IN),
		array(&$myparams['categoriaID'], SQLSRV_PARAM_IN)
	);
			
		//exec sp_update_product 5,"jamon","rey","1500", 5,"zzz","wheh","proximo",1;
		//$sql = "sp_update_product $_PlatilloID,'$_ProductName','$_ProductDescript',
		//'$_ProductPrice', $_ProductCantidad,'$name','$image','Activo','$_ProductCategoria' ";

		$sql = "sp_update_product @productoID =? ,@nombre = ?,@descripcion = ?,@precio = ?,@cantidad = ?,
		@imageNombre = ?, @imagen = ?,@estado = 'activo',@categoriaID = ?";
        $stmt = sqlsrv_prepare($Conn, $sql,$procedure_params);
		if(sqlsrv_execute($stmt))
		{
			echo '<script>window.alert("Product has been successfully updated!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
/*
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
		*/
	}else if($ProductAction == "Delete")
	{
		$_PlatilloID = $_GET["productoID"];
		
		$sql = "sp_estado_product $_PlatilloID,'Inactivo'";
		$stmt = sqlsrv_query($Conn, $sql);

		if($stmt)
		{
			echo '<script>window.alert("Product has been successfully Deleted!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	}

?>








