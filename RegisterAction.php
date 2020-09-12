<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php

//  Datos
$ActionType = $_GET['ActionType'];
$Location = $_GET["Loc"];
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Firstname = $_POST['Firstname'];
$Middlename = $_POST['Middlename'];
$Lastname = $_POST['Lastname'];
$Telefono = $_POST['Telefono'];
//$Gym = $_POST['Gym'];
$EmailAddress = $_POST['EmailAddress'];

if (empty($Username) || empty($Password) || empty($Firstname) || empty($Middlename) || empty($Lastname) || empty($EmailAddress)|| empty($Telefono)) {
	echo '<script>window.alert("Cannot leave the page blank"); window.open("register.php","_self",null,true);</script>';
} else {
	if ($ActionType == "Register") {
	   require 'Connection.php';
		//$pass_cifra = password_hash($Password,PASSWORD_BCRYPT);
		$sql = "INSERT INTO tbl_usuario(usuario,contrasenna,rol,nombre, primerApellido, segundoApellido,telefono,correo) VALUES ('$Username','$Password','User','$Firstname','$Middlename','$Lastname',$Telefono,'$EmailAddress')";

		$res = sqlsrv_query($Conn, $sql);
		
		if ($res) {
			echo '<script>window.alert("Registro Completado Por favor Ingresar"); window.open("Login.php?Role=User","_self",null,true);</script>';
			
		
		} else {
			echo "Estamos en la piedra";
			die(print_r( sqlsrv_errors(), true));  
		}
	} else {
		$ID = $_GET['ID'];
      	$sqlI = "UPDATE `tbl_customers` SET `Username`='$Username',`Password`='$Password',`Firstname`='$Firstname'," .
			"`Middlename`='$Middlename',`Lastname`='$Lastname',`Address`='$Address',`EmailAddress`='$EmailAddress' WHERE CustomerID = $ID";
		$res = mysqli_query($Conn, $sqlI);
		if (!$res) {
			echo "Failed " . mysqli_connect_error();
		} else {
			if ($Location == "MA") {
				echo '<script>window.open("ManageAccount.php","_self",null,true);</script>';
			} else if ($Location == "MC") {
				echo '<script>window.open("Management_Customers.php","_self",null,true);</script>';
			}
		}
	}
}