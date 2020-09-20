<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Order</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" 
	rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" 
	rel="stylesheet" type="text/css">
	<style>
		#pdetails span{
			float: right;
		}
	</style>
</head>

<body>
        
    <br>
    <img id="logo" src="img/narime.jpg" alt="User">
    <br>
    <div class="address-bar"><strong>Cheap</strong> Shoes for Everyone</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Entrega NarimeWeb</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
					<li><a href="bestseller.php">Best Sellers</a></li>
					<li><a href="shop.php">Menú</a></li>
                    <li><a href="about.php">About</a></li>
					<li><a href="#" onclick="ManagementOnclick();">Management</a></li>
                </ul>
            </div>
        </div>
    </nav>
	
	<?php
        require 'Connection.php';
        
		$UN = $_SESSION['Username'];
		$PASS = $_SESSION['Password'];
        $PlatilloID = $_GET['PlatilloID'];
        //$PlatilloID = $_GET['PlatilloID'];
		
		if(empty($UN)){echo '<script>window.open("Login.php?Role=User","_self",null,true);</script>';}
		
		$sql = "SELECT * FROM tbl_usuario WHERE usuario = '".$UN."' and contrasenna = '".$PASS."' and rol = 'User'";
		$res = sqlsrv_query($Conn,$sql);
		while($Rows = sqlsrv_fetch_array($res)){
            $CustomerID = $Rows[0];
            //$Especificacion = $Rows[5];
		}
	?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Order</h2>
                    <hr><br>
                </div>

                <div class="col-md-6">
                 <form role="form" action="OrderAction.php?PlatilloID=<?php echo $PlatilloID; ?>&CustomerID=<?php echo $CustomerID; ?>" method="POST">
					<div class="form-group">
					  <label for="PlatilloID">Platillo ID:</label>
					  <input type="text" name="PlatilloID" class="form-control" id="PlatilloID" value="<?php echo $PlatilloID; ?>" disabled>
					</div>
					<div class="form-group">
					  <label for="CustomerID">Customer ID:</label>
					  <input type="text" name="CustomerID" class="form-control" id="CustomerID" value="<?php echo $CustomerID; ?>" disabled>
					</div>
				<!--Cambiar para alguna espeficacion de Platillo-->
					<div class="form-group">
						<label for="Espeficacion">Espeficaciones:</label>
						<input type="text" name="Espeficacion" class="form-control" id="Espeficacion">
					</div>
					<div class="form-group">
						<!--<label for="Estado">Estado:</label>-->
						<input type="hidden" name="Estado" class="form-control" id="Estado" value="Pendiente">
					</div>
						<button type="submit" style="float: right;" class="btn btn-default">Submit</button>
					</form>
				</div>
                
                <div class="clearfix"></div>
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>