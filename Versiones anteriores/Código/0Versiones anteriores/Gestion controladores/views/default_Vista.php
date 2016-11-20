<html> 
	<!-- Titulo de la página e include de la cabecera -->
	<title>Principal</title>
	<?php
	session_start();
	if(isset($_SESSION['user'])){
		include_once('../header.php');
	?>
	
	<!-- Include del menú lateral -->
	<body>
		<div class="container-fluid text-center">
			<div class="row content">
				<?php include_once('menu.php'); ?>
				<div class="col-sm-10 text-left">
					<div class="section-fluid">
						<div class="container-fluid">
							<!-- Aqui se muestra el calendario en la ET2 -->
							<img class="img-responsive" src="../images/background.jpg">
						</div>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>

<?php 
}else{
	echo "Permiso denegado.";
}
?>
