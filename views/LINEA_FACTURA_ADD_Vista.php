<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Linea_Factura_Add',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class LineaFactura_Crear{

	function __construct($idFactura=null){
		$this->render($idFactura);
	}

	function render($idFactura){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo crear linea']; ?></title>

		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['crear linea']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Si no hay servicio seleccionado se muestra un forulario para escribir un servicio -->
					<?php if(!isset($_POST['service'])){ ?>
					<form class="form-horizontal" role="form" action="LINEA_FACTURA_Controller.php?id=altaLinea" method="POST">
						<div class="form-group">
							
							<!-- Input oculto con el id de la factura -->
							<input type="hidden" class="form-control" name="factura" value="<?php echo $idFactura; ?>">
							
							<!-- Input para buscar servicio -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['nombre servicio']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="service" pattern="[A-Za-zÁÉÍÓÚÑñáéíóú ]{2,30}" title="<?php echo $strings['error nombre servicio']; ?>">
								</div>
							</div>
							
							<!-- Submit que envía texto para buscar el servicio -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					<!-- Si hay un post con el texto a buscar se muestra un forulario para seleccionar un servicio -->
					<?php }else { ?>
					<form class="form-horizontal" role="form" id="formulario" action="LINEA_FACTURA_Controller.php?id=altaLinea" method="POST">
						<div class="form-group">
							
							<!-- Input oculto con el id de la factura -->
							<input type="hidden" class="form-control" name="factura" value="<?php echo $_POST['factura']; ?>">
							
							<!-- Muestra una lista de los servicios que coinciden con la búsqueda -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['servicio']; ?>:</label>
								</div>
								<div class="col-sm-4">
									<?php $ret = verServicios($_POST['service']); 
									if($ret == "no hay"){ echo $strings["no hay"]; ?>
								</div>
							</div>
							
							<?php }else{ ?>
							</div></div>
							<!-- Input para añadir descripción -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <textarea type="text" form="formulario" class="form-control" name="descripcion" maxlength="250"></textarea>
								</div>
							</div>
							
							<!-- Submit que envía datos para crear la linea de factura -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
						<?php } ?>
					</form>
					<?php } ?>
					
					<!-- Botón volver atrás -->
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=consultarFactura" method="POST">
						<div class="form-group">		
							<input type="hidden" class="form-control" name="factura" value="<?php echo $idFactura; ?>">
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