<?php session_start(); ?>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Productos</title>

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
		$ProductAction = $_GET["ProductAction"];
		if(empty($_SESSION['Admin'])){echo '<script>window.open("index.php","_self",null,true);</script>';}else{
          
          require 'Connection.php';
            $ID = $_GET['productoID'];

            $sql = "select * from tbl_producto where productoID= '".$ID."'";
            $Res = sqlsrv_query($Conn,$sql);
            while($Rows = sqlsrv_fetch_array($Res))
            {
               
                $C_Platilloname = $Rows[1];
                $C_PlatilloDescript = $Rows[2];
                $C_PlatilloPrice = $Rows[3];
                $C_ProductCatidad= $Rows[4];
                $C_CategoriaID= $Rows[8];
                //$C_name= $Rows[5];
                
                
            }
        }
		?>
</head>

<body>

    <div class="brand">Entregas NarimeWeb</div>
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
					<li><a href="Management_Products.php?ProductAction=Add">Productos</a></li>
                    
                    <li><a href="Management_ProductsList.php">Lista de Productos</a></li>
                    <li><a href="Management_Customers.php">Clientes</a></li>
					
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">Productos</h2>
						<hr>

					<div class="col-md-12">	
						<div class="col-md-6">	
							<form role="form" action="Management_Products_Action.php?ProductAction=
							<?php echo $ProductAction; if($ProductAction=="Edit"){ echo "&productoID=".$_GET['productoID'];} ?>" 
							method="POST" enctype = "multipart/form-data">
							
							<div class="form-group">
							  <label for="ProductName">Nombre de Platillo:</label>
							  <input type="text" name="PlatilloName" class="form-control" id="ProductName" value="<?php if(isset( $C_Platilloname )){ echo $C_Platilloname;} ?>" required>
							</div>
							
							<div class="form-group">
							  <label for="ProductBrand">Descripcion del Platillo:</label>
							  <textarea type="text" name="PlatilloDescript" class="form-control" id="PlatilloDescript" required><?php if(isset(  $C_PlatilloDescript )){ echo  $C_PlatilloDescript;} ?></textarea>
                            </div>
                
							<div class="form-group">
						<!--<label for="Estado">Estado:</label>-->
						  <input type="hidden" name="Estado" class="form-control" id="Estado" value="Activo">
		                        </div>

							<div class="form-group">
							  <label for="PlatilloPrice">Precio del Platillo:</label>
							  <input type="text" name="PlatilloPrice" class="form-control" id="ProductPrice" value="<?php if(isset(  $C_PlatilloPrice )){ echo  $C_PlatilloPrice;} ?>" required>
							</div>

                            <div class="form-group">
							  <label for="PlatilloQuantity">Cantidad:</label>
							  <input type="text" name="PlatilloQuantity" class="form-control" id="PlatilloQuantity" value="<?php if(isset(  $C_ProductCatidad )){ echo  $C_ProductCatidad;} ?>" required>
							</div>

                            <!--<div class="form-group">
							  <label for="ProductImage">Nombre de la Imagen:</label>
							  <input type="text" name="ProductImage" class="form-control" id="ProductImage" value="?php if(isset(  $C_name )){ echo  $C_name;} ?>" required>
							</div>-->

                            <div class="form-group">
							  <label for="CategoriaID">Categoría:</label>
							  <input type="text" name="CategoriaID" class="form-control" 
                              id="CategoriaID" value="<?php if(isset(  $C_CategoriaID )){ echo  
                              $C_CategoriaID;} ?>" required>
							</div>

						</div>

						<div class="col-md-6">	
							<div class="form-group">
								<label for="ProductImage">Imagen de Platillo:</label>
								<input type="file" name="ProductImage">
							</div>
							
							<div class="form-group">
							<button type="submit" style="float: left;" class="btn btn-default">Enviar</button>
							</div>
						</div>
						</form>
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
	<script>
		$(document).ready(function(){
			
		});
	</script>

</body>

</html>
