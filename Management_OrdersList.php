<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Products</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<?php
	//	if(empty($_SESSION['Admin'])){echo '<script>window.open("index.php","_self",null,true);</script>';}
	?>
</head>

<body>
    <br>
    <img id="logo" src="img/narime.jpg" alt="User">
    <br>
    <div class="address-bar"><strong>Directo</strong> y a la puerta de tu casa</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Entregas NarimeWeb</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Inicio</a></li>
					<li><a href="Management_Orders.php">Órdenes</a></li>
					<li><a href="Management_ProductsList.php">Productos</a></li>
                    <li><a href="Management_Customers.php">Clientes</a></li>
                    <li><a href="Management_OrdersList.php">Historial</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">Órdenes</h2>
						<hr>
						<div class="table-responsive">
							<table border="5px" class="table">
								<tr style="text-align: center; color: Black; font-weight: bold;">
									<td>ID de Orden</td>
									<td>ID de Cliente</td>
									<td>Nombre de Platillo</td>
									<td>Descripción</td>
									<td>Estado</td>
									<td>Espeficaciones</td>
									<td>Precio de Platillo</td>
									<td>Fecha de Orden</td>
								
								</tr>
								
								<?php 
								require 'Connection.php';
								$sqlI = "sp_list_orders_canceled_complete";
								/*$sqlI = "SELECT tbl_orders.OrderID, tbl_orders.CustomerID, tbl_platillos.Platilloname, tbl_platillos.PlatilloDescript, tbl_orders.Estado, 
								tbl_orders.Especificacion, tbl_platillos.PlatilloPrice, tbl_orders.DateOrdered FROM tbl_platillos RIGHT JOIN 
								 tbl_orders on tbl_orders.PlatilloID = tbl_platillos.PlatilloID where tbl_orders.Estado='Completado' or tbl_orders.Estado='Cancelado' ORDER BY tbl_orders.OrderID";*/
								$Resulta = sqlsrv_query($Conn,$sqlI);
								while($Rows = sqlsrv_fetch_array($Resulta)):;  
								?>
								<tr style="color: black">
								<td><?php echo $Rows[0]; ?></td>
								<td><?php echo $Rows[1]; ?></td>
								<td><?php echo $Rows[2]; ?></td>
								<td><?php echo $Rows[3]; ?></td>
								<td><?php echo $Rows[4]; ?></td>
								<td><?php echo $Rows[5]; ?></td>
								<td><?php echo $Rows[6]; ?></td>
								<td><?php echo $Rows[7]; ?></td>
								
								<?php endwhile; ?>
								</tr>
							</table>
						</div>
					
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Narime</p>
                </div>
            </div>
        </div>
    </footer>	

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
