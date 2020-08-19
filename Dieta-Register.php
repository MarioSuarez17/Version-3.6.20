
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php

require 'Connection.php';


$ActionType = $_GET['ActionType'];
//$Location = $_GET["Loc"];
$Proteina = $_POST['Proteina'];
$Fruta = $_POST['Fruta'];
$Vegetal = $_POST['Vegetal'];
$Harina = $_POST['Harina'];
$Tipo = $_POST['Tipo'];


if (empty($Proteina) || empty($Fruta) || empty($Vegetal) || empty($Harina) || empty($Tipo)) {
	echo '<script>window.alert("Cannot leave the page blank"); window.open("register.php","_self",null,true);</script>';
} else {
	//if ($ActionType == "Register") {
        $ID = $_GET['id'];
		
		$sql = "INSERT INTO `tbl_dieta`(`tipo`,`proteina`,`fruta`,`vegetal`, `harinas`, `CustomerID`)" .
			" VALUES ('$Tipo','$Proteina','$Fruta','$Vegetal','$Harina',$ID)";

		$res = mysqli_query($Conn, $sql);
		
		if (!$res) {
		
			echo "Failed " . mysqli_connect_error();
		
		} else {
			echo '<script>window.alert("Registro Completado Por favor Ingresar"); window.open("Login.php?Role=User","_self",null,true);</script>';
		}
	} 
//}