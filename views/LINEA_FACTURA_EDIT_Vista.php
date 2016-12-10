<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Linea_Factura_Edit',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class LineaFactura_Editar{

	function __construct($array=null){
		$this->render($array);
	}

	function render($array){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo editar linea']; ?></title>
		
		<script src="../bootstrap/tcal.js"></script>	
		<script>
		//Confirma modificación.
		function confirmar(){
		if (confirm('<?php echo $strings['confirmar modificacion']; ?>\n\n'+
			'<?php echo $strings['numero linea']; ?>: <?php echo $array['Id_Linea_Factura'] ?>\n\n'+
			'<?php echo $strings['servicio']; ?>: <?php echo $array['Nombre'] ?>\n\n'+
			'<?php echo $strings['importe']; ?>: '+document.getElementById("precio").value+'\n\n'+
			'<?php echo $strings['descripcion2']; ?>: '+document.getElementById("descripcion").value+'\n')){
			   document.formulario.submit();
			} else return false;	
		}
		</script>
		
		<link rel="stylesheet" type="text/css" href="../bootstrap/tcal.css" media="screen" />
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar linea']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formularioo para editar linea -->
					<form class="form-horizontal" role="form" id="formulario" action="LINEA_FACTURA_Controller.php?id=modificarLinea" method="POST" onsubmit="return confirmar()">
						<div class="form-group">
							
							<!-- Inputs ocultos con factura y linea -->
							<input type="hidden" name="factura" value="<?php echo $array['Id_Factura'] ?>">
							<input type="hidden" name="linea" value="<?php echo $array['Id_Linea_Factura'] ?>">
							
							<!-- Muestra el servicio de la linea -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['servicio']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <?php echo $array['Nombre'] ?>
								</div>
							</div>
							
							<!-- Input para modificar precio -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['importe']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <input type="text" class="form-control" id="precio" name="importeN" value="<?php echo $array['Importe'] ?>" pattern="(\d{1,3})(\.\d{2})?" title="<?php echo $strings['error importe linea']; ?>">
								</div>
							</div>
							
							<!-- Input para modificar descripción -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <textarea type="text" form="formulario" class="form-control" id="descripcion" name="descripcionN" maxlength="250"><?php echo $array['Descripcion'] ?></textarea>
								</div>
							</div>
							
							<!-- Submit para modificar linea factura -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					<!-- Botón volver atrás -->
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=consultarFactura" method="POST">
						<div class="form-group">		
							<input type="hidden" class="form-control" name="factura" value="<?php echo $array['Id_Factura']; ?>">
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