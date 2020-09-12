<?php

//phpinfo()
 
$serverName = "DESKTOP-O5HPCF6";
//$connectionInfo = array( "Database"=>"narime");
$connectionInfo = array( "Database"=>"narime", "UID"=>"sa", "PWD"=>"Jomsc1706");
$Conn = sqlsrv_connect( $serverName, $connectionInfo);
 
if($Conn) {
     echo "Conexión establecida.<br />";
}else {
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}



?>