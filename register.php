<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php 
    $C_Username='';
    
    session_start(); 
    $ActionType = $_GET['ActionType'];
    require 'Connection.php';
	if($ActionType == "Edit" && isset($_GET['ID']) && isset($_GET['Loc'])){
		$ID = $_GET['ID'];
        $Loc = $_GET['Loc'];

		$sql = "select * from tbl_customers where CustomerID= '".$ID."'";
		$Res = mysqli_query($Conn,$sql);
		while($Rows = mysqli_fetch_array($Res))
		{
			$C_ID = $Rows[0];
			$C_Username = $Rows[1];
			$C_Password = $Rows[2];
			$C_Firstname = $Rows[4];
			$C_Middlename = $Rows[5];
			$C_Lastname = $Rows[6];
			$C_Address = $Rows[7];
			$C_Email = $Rows[8];
		}

	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if($ActionType == "Register"){echo "Register an Accout";}else echo "Edit Account Information"; ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{
			$Username = $_SESSION["Username"];
        }
        



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
					<li><a href="bestseller.php">Más Vendidos</a></li>
					<li><a href="shop.php">Menú</a></li>
                    <li><a href="about.php">Nosotros</a></li>
					<?php if($Username == null){echo '<li><a href="register.php?ActionType=Register">Registro</a></li>';} ?>
					<?php if($Username == null){echo '<li><a href="Login.php?Role=User">Ingresar</a></li>';} else {echo '<li><a href="Logout.php">Cerrar Sesión</a></li>';} ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center"><?php if($ActionType == "Register"){echo "Registro";}else echo "Edita la Información de tu Cuenta"; ?></h2>
						<hr>
					<div class="col-md-6">	
							<form role="form" action="RegisterAction.php?ActionType=<?php echo $ActionType; if($ActionType == "Edit"){ echo "&Loc=" . $Loc . "&ID=" .$ID;} ?>" 
							method="POST">
							
                            <div class="form-group">
							  <label for="username">Username:</label>
							  <input type="text" name="Username" class="form-control" id="Username" value="<?php if(isset($C_Username)){ echo $C_Username;} ?>" readonly>
							</div>
							
							<div class="form-group">
							  <label for="Password">Password:</label>
							  <input type="Password" name="Password" class="form-control" id="Password" value="<?php if(isset( $C_Password)){ echo $C_Password;} ?>" readonly>
							</div>

							<div class="form-group">
							  <label for="Firstname">Firstname:</label>
							  <input type="text" name="Firstname" class="form-control" id="Firstname" value="<?php if(isset($C_Firstname)){ echo $C_Firstname;} ?>">
							</div>
							
							<div class="form-group">
							  <label for="Middlename">Middlename:</label>
							  <input type="text" name="Middlename" class="form-control" id="Middlename" value="<?php if(isset($C_Middlename)){ echo $C_Middlename;} ?>" readonly>
							</div>
							
							<div class="form-group">
							  <label for="Lastname">Lastname:</label>
							  <input type="text" name="Lastname" class="form-control" id="Lastname" value="<?php if(isset($C_Lastname)){echo $C_Lastname; }?>" readonly>
							</div>
							
							<div class="form-group">
							  <label for="Address">Address:</label>
							  <input type="text" name="Address" class="form-control" id="Address" value="<?php if(isset($C_Address)){ echo $C_Address;} ?>" >
							</div>
							
							<div class="form-group">
							  <label for="EmailAddress">Email Address:</label>
							  <input type="email" name="EmailAddress" class="form-control" id="EmailAddress" value="<?php if(isset($C_Email)){ echo $C_Email;} ?>" readonly>
							</div>
                            
                            <div>
        <!--MENU-->
     
        Gym: <select class="form-control" name="Gym">
            <option></option>
                         <?php
                 require 'Connection.php';
       
              $sql = ("SELECT * FROM tbl_gimnasio WHERE Estado='Activo'");
              $res = mysqli_query($Conn,$sql);

                	while($Rows = mysqli_fetch_array($res))
		         {
                  echo '<option value="'.$Rows[0].'">'.$Rows[1]. '</option>';
                }
            
      ?>
          
      </select>
          
            </div>

            <br>
							
				
							<button type="submit" class="btn btn-default">Enviar</button><br><br>
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

</body>

</html>
