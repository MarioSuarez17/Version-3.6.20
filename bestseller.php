<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Best Sellers</title>
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{$Username = $_SESSION["Username"];}
?>
</head>

<body>
	<br>
    <img id="logo" src="img/narime.jpg" alt="User">
    <br>
    <div class="address-bar"><strong>Directo</strong> Y a la puerta de tu casa</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Entregas ConfiguroWeb</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				<li><a href="index.php">Inicio</a></li>
					<li><a href="bestseller.php">Productos más Populares</a></li>
					<li><a href="shop.php">Menú</a></li>
                    <li><a href="about.php">Nosotros</a></li>
					<li><a href="#" onclick="ManagementOnclick();">Administrador</a></li>
					<?php if($Username == null){echo '<li><a href="register.php?ActionType=Register">Registrarse para Pedidos</a></li>';} ?>
					<?php if($Username == null){echo '<li><a href="Login.php?Role=User">Ingresar</a></li>';} else {echo '<li><a href="Logout.php">Logout</a></li>';} ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

			<div class="row">
				<div class="box" style="border-radius: 10px;">
					<div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">Top 5 Los <strong>Más</strong> Vendidos</h2>
						<hr>
					</div><br></br>
				</div>
			</div>

			<?php
				$num = 5;
				require 'Connection.php';
				//$sql = "SELECT * FROM `tbl_platillos` WHERE `Estado`='Activo'  Limit 5";
				$sql = "sp_query_product_activo";
				$Resulta = sqlsrv_query($Conn,$sql);
				while($Rows = sqlsrv_fetch_array($Resulta)){
					echo '	
						<div class="row">
							<div class="box" style="border-radius: 10px;">
								<div class="col-lg-12">
									<hr>
									<h2 class="intro-text text-center">Top '. $num.'</h2>
									<hr>
									<img class="img-responsive img-border img-left" src="data:image;base64,'.$Rows[6].'" alt="">
									<hr class="visible-xs">
									<p><strong>Nombre del Platillo:</strong> '.$Rows[1].'</p>
									<p><strong>Descripcion:</strong> '.$Rows[2].'</p>
									<p><strong>Precio: $</strong> '.$Rows[3].'</p>
									<a onclick="addToCartOnclick('.$Rows[0].');" href="#"  style="margin-bottom: 5px;" class="btn btn-primary">Agregar al Carro</a>
								</div>
							</div>
						</div>';
					$num--;
				}
			?>
	</div>


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
	<script>
		function ManagementOnclick(){
			if(confirm("Solo los administradores tienen permitido acceder a esta página. Inicie sesión como administrador.") == true)
			{
				window.open("Login.php?Role=Admin","_self",null,true);
			}
		}
		function addToCartOnclick(PlatilloID)
		{	
			if(confirm("Are you sure you want to add this product to your cart?") == true){
			window.open("Order.php?PlatilloID="+PlatilloID,"_self",null,true);
			}
		}
	</script>

</body>

</html>
