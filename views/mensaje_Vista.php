<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión antes de cargar la página.
if(isset($_SESSION['grupo'])){ 

//Crea la clase e instancia la función render en el constructor. 
class Mensaje_Vista{
	
	//Crea una ventana con el mensaje pasado por parámetro.
	function __construct($mensaje){
		$this->render($mensaje);
	}

	function render($mensaje){
		include_once('../header.php'); 
?>
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<!-- Muestra el mensaje en una ventana -->
					<div class="form-group">
						<div class="col-md-12"><hr></div>
						<script>
							window.alert('<?php echo $strings[$mensaje]; ?>');
						</script>
					</div>
				  </div>
				</div>
			</div>
		  </div>
		</body>
<?php 
	} 
}
}else{
	echo "Permiso denegado.";
}
?>