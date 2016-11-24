<html> 
	<!-- Titulo de la página e include de la cabecera -->
	<?php
	session_start();
	if(isset($_SESSION['user'])){
		include_once('../header.php');
	?>
	<title><?php echo $strings['principal']; ?></title>
	
	<!-- Include del menú lateral -->
	<body>
		<div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10">
				<div class="section-fluid">
					<div class="container-fluid">
					
						<!-- Aqui se mostrará el calendario -->
						<img class="img-responsive" src="../images/background.jpg">
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