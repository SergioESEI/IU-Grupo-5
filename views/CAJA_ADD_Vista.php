<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Caja_Add',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Caja_Crear{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo añadir movimiento']; ?></title>

		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['añadir movimiento']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para añadir movimiento -->
					<form class="form-horizontal" role="form" id="formulario" action="CAJA_Controller.php?id=altaCaja" method="POST">
						<div class="form-group">
							
							<!-- Input oculto con la fecha actual -->
							<input class="tcal" type="hidden" name="fecha" value="<?php echo date("Y-m-d"); ?>">
							
							<!-- Muestra el total de dinero que hay en caja -->
							<div class="form-group">
							<div class="col-sm-2">
							  <label for="nombre" class="control-label"><?php echo $strings['total caja']; ?>:</label>
							</div>
								<div class="col-sm-8">
								 <?php echo calcularTotal()." €"; ?>
								</div>
							</div>
							
							<!-- Input para indicar tipo de movimiento -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['tipo movimiento']; ?>:</label>
							</div>
								<div class="col-sm-4">
								 <label class="radio-inline"><input type="radio" name="movimiento" value="Ingreso" checked><?php echo $strings['ingreso caja']; ?></label>
								<label class="radio-inline"><input type="radio" name="movimiento" value="Pago"><?php echo $strings['pago caja']; ?></label>
								</div>
							</div>
							
							<!-- Input para indicar importe -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['importe caja']; ?>:</label>
							</div>
								<div class="col-sm-4">
								<input type="text" class="form-control" name="importe" pattern="(\d{1,3})(\.\d{2})?" title="<?php echo $strings['error importe caja']; ?>" required>
								</div>
							</div>
							
							<!-- Input opcional de comentario -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['comentario opcional']; ?>:</label>
							</div>
								<div class="col-sm-4">
								<textarea type="text" form="formulario" class="form-control" name="comentario" maxlength="250"></textarea>
								</div>
							</div>
							
							<!-- Submit para modificar el movimiento -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					</div>
				  </div>
				</div>
			</div>
		</body>
<?php 
		}
	}
}else
	echo "Permiso denegado.";
?>