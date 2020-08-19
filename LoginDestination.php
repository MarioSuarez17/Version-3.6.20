<?php
session_start();
require 'Connection.php';
include('Connection.php');

$_un = $_POST['Username'];
$_pass = $_POST['Password'];
$_Role = $_GET['Role'];

$query = "SELECT * FROM `tbl_customers` WHERE `Username` = '" . $_un . "' and `Role` = '" . $_Role . "'";
$res = mysqli_query($Conn, $query);
if ($res === false) {
	die("Error" . mysqli_error($Conn));
}
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

if ($row) {
	if ($_Role == "User") {
		$_SESSION["Username"] = $_un;
		$_SESSION["Password"] = $_pass;
		echo "<script>window.open('index.php','_self',null,true)</script>";
		die("Logged in");
	} else if ($_Role == "Admin") {
		$_SESSION['Admin'] = "Logged";
		echo "<script>window.open('Management_Orders.php','_self',null,true)</script>";
	}
} else {
die("Usuario o contraseña mal ingresada"  );
}
