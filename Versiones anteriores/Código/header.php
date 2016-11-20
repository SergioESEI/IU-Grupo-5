<html>
	<head>

	<!-- Se incluyen todos los elementos del framework -->
    <meta charset="utf-8">  
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../bootstrap/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <link href="../bootstrap/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/bootstrap.css" rel="stylesheet" type="text/css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script src="../bootstrap/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script> 
	
	<?php 
	//Carga el idioma guardado en la variable de sesión o el Español por defecto
	if(isset($_SESSION['lang'])){
		if(strcmp($_SESSION['lang'],'gal')==0)
			include("../locates/Strings_GALEGO.php"); 
		else if(strcmp($_SESSION['lang'],'esp')==0)
			include("../locates/Strings_ESPAÑOL.php"); 
	}else{
		include("../locates/Strings_ESPAÑOL.php"); 
	}
	?>
	
    <style>
      /* Remove the navbar's default margin-bottom and rounded borders */
		  .navbar {
			margin-bottom: 0;
			border-radius: 0;
		  }
		  
		  /* Set gray background color and 100% height */
		  .sidenav {
			padding-top: 20px;
			background-color: #f1f1f1;
			height: 100%;
		  }
    </style>

  <!-- Menú de la cabecera: regreso a la pantalla inicial, logout y cambio de idioma -->
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
		<div class="navbar-header">
		  <img src="../images/logo.png">
		</div>
		<ul class="nav navbar-nav">
		  <li><a class="active" href="default_Vista.php"><?php echo $strings['principal']; ?></a></li>
		  <li><a href="../logout.php"><?php echo $strings['desconectarse']; ?></a></li>
		</ul>
		<ul class="navbar-right">
			<p class="text-warning"><?php echo $strings['logueado'].": ".$_SESSION['user']; ?> 
			<a href="../models/cambiaIdioma.php?lang=esp">
			<img src="../images/español.png"></a>
			<a href="../models/cambiaIdioma.php?lang=gal">
			<img src="../images/gallego.png"></a></p>
		</ul>
		</div>
    </nav>

</head></html>