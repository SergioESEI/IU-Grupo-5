<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura_Add',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Factura_Crear{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo crear factura']; ?></title>

		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['crear factura']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para introducr una cadena con el nombre del cliente a buscar -->
					<?php if(!isset($_POST['client'])){ ?>
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=altaFactura" method="POST">
						<div class="form-group">
							
							<!-- Input para buscar clientes -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['nombre cliente']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="client" pattern="[A-Za-zÁÉÍÓÚÑñáéíóú ]{2,30}" title="<?php echo $strings['error nombre cliente']; ?>" required>
								</div>
							</div>
							
							<!-- Submit para buscar cliente -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					<!-- Formulario para seleccionar cliente en base a la cadena pasada -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=altaFactura" method="POST">
						<div class="form-group">
							
							<!-- Muestra una lista de los clientes que coinciden con la búsqueda -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['cliente']; ?>:</label>
								</div>
								<div class="col-sm-4">
									<?php $ret = verClientes($_POST['client']); 
									if($ret == "no hay"){ echo $strings["no hay"]; ?>
								</div>
							</div>
							
						<?php }else{ ?>
							</div></div>
							<!-- Submit que envía datos para crear factura -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
							 </div>
						</div>
						<?php } ?>
						
						<!-- Botón volver atrás -->
						 <a href="FACTURA_Controller.php?id=altaFactura" class="btn navbar-btn">
						<span style="font-size:19px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-left"></span></a>
					</form>
					<?php } ?>
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