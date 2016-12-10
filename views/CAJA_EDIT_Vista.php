<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Caja_Edit',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Caja_Editar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo editar movimiento']; ?></title>
		
		<script>
		//Confirma modificación.
		function confirmar(){
		if (confirm('<?php echo $strings['confirmar modificacion']; ?>\n\n'+
			'<?php echo $strings['fecha caja']; ?>: '+document.getElementById("fecha").value+'\n\n'+
			'<?php echo $strings['tipo movimiento']; ?>: '+document.getElementById("movimiento").value+'\n\n'+
			'<?php echo $strings['importe caja']; ?>: '+document.getElementById("importe").value+'€\n\n'+
			'<?php echo $strings['comentario']; ?>: '+document.getElementById("comentario").value+'\n')){
			   $('#formulario').submit();
			} else return false;	
		}
		</script>
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar movimiento']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para editar movimiento -->
					<form class="form-horizontal" role="form" id="formulario" action="CAJA_Controller.php?id=modificarCaja" method="POST">
						<div class="form-group">
							
							<!-- Input oculto con el id del movimiento -->
							<input type="hidden" name="id" value="<?php echo $_POST["id"]; ?>">
							
							<!-- Muestra el total de dinero que hay en caja -->
							<div class="form-group">
							<div class="col-sm-2">
							  <label for="nombre" class="control-label"><?php echo $strings['total caja']; ?>:</label>
							</div>
								<div class="col-sm-8">
								 <?php echo calcularTotal()." €"; ?>
								</div>
							</div>
							
							<!-- Muestra la fecha -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['fecha caja']; ?>:</label>
							</div>
							<div class="col-sm-4">
								<?php echo $_POST["fecha"]; ?>
								<input type="hidden" id="fecha" name="fecha" value="<?php echo $_POST["fecha"]; ?>">
								</div>
							</div>
							
							<!-- Muestra el tipo de movimiento -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['tipo movimiento']; ?>:</label>
							</div>
							<div class="col-sm-4">
								<?php echo $_POST["movimiento"]; ?>
								<input type="hidden" id="movimiento" name="movimiento" value="<?php echo $_POST["movimiento"]; ?>">
								</div>
							</div>
							
							<!-- Input para indicar importe -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['importe caja']; ?>:</label>
							</div>
								<div class="col-sm-4">
								<input type="text" class="form-control" id="importe" name="importeN" value="<?php echo $_POST["importe"]; ?>" pattern="(\d{1,3})(\.\d{2})?" title="<?php echo $strings['error importe caja']; ?>" required>
								</div>
							</div>
							
							<!-- Input opcional de comentario -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['comentario opcional']; ?>:</label>
							</div>
								<div class="col-sm-4">
								<textarea type="text" form="formulario" class="form-control" id="comentario" name="comentarioN" maxlength="250"><?php echo $_POST["comentario"]; ?></textarea>
								</div>
							</div>
							
							<!-- Submit para modificar el movimiento -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="button" onclick="return confirmar()">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					<!-- Botón volver atrás -->
					<form class="form-horizontal" role="form" action="CAJA_Controller.php?id=consultarCaja" method="POST">
						<div class="form-group">		
							<div class="col-sm-4"><button type="submit" class="btn btn-link btn-lg" aria-label="Left Align">
							  <span class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-left"></span>
							</button></div>
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