<?php

//reload() Probar 
	require 'Connection.php';
    $ID = $_GET["id"];
    
	$sql = "UPDATE tbl_gimnasio SET Estado = 'Desactivo' where  GinmasioID =   $ID";
    
    $res = mysqli_query($Conn,$sql);
	if($res){
		echo '<script>window.open("Management_AddGym.php","_self",null,true);</script>';
	}
	
?>