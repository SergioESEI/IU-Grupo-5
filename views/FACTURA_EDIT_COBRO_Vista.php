<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura_Edit',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Factura_Cobrar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo modificar factura']; ?></title>
		
		<script>
		//Confirma cobro.
		function confirmar(){
		if (confirm('<?php echo $strings['confirmar cobro']; ?>')){
			   $('#formulario').submit();
			} else return false;	
		}
		</script>
		<script src="../bootstrap/tcal.js"></script>	
	  
		<link rel="stylesheet" type="text/css" href="../bootstrap/tcal.css" media="screen" />
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['modificar factura']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para cobrar factura -->
					<form class="form-horizontal" role="form" id="formulario" action="FACTURA_Controller.php?id=cobrarFactura" method="POST">
						<div class="form-group">
						
							<!-- Input oculto con el id de la factura, fecha e importe -->
							<input type="hidden" name="factura" value="<?php echo $_POST['factura']; ?>">
							<input class="tcal" type="hidden" name="fecha" value="<?php echo date("Y-m-d"); ?>">
							<input type="hidden" id="total" name="total" value="<?php echo $_POST['total']; ?>">
							
							<!-- Muestra el cliente -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['cliente']; ?>:</label>
								</div>
								<div class="col-sm-4">
									<?php echo $_POST['n_cliente']; ?>
								</div>
							</div>
							
							<!-- Muestra la fecha de cierre -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['fecha cierre']; ?>:</label>
								</div>
								<div class="col-sm-4">
									<?php echo $_POST['date']; ?>
								</div>
							</div>
							
							<!-- Muestra el total -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['total factura']; ?>:</label>
								</div>
								<div class="col-sm-4">
									<?php echo $_POST['total']."€"; ?>
								</div>
							</div>
							
							<!-- Input para modifcar el estado del cobro -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['tipo cobro factura']; ?>:</label>
							</div>
								<div class="col-sm-4">
								 <label class="radio-inline"><input type="radio" name="pagada" value="Efectivo" checked><?php echo $strings['efectivo']; ?></label>
								<label class="radio-inline"><input type="radio" name="pagada" value="Domiciliacion"><?php echo $strings['domiciliacion']; ?></label>
								<label class="radio-inline"><input type="radio" name="pagada" value="TPV"><?php echo $strings['tpv']; ?></label> 
								</div>
							</div>
							
							<!-- Submit para modificar el cobro -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['cobrar']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					<!-- Botón volver atrás -->
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=consultarFactura" method="POST">
						<div class="form-group">		
							<input type="hidden" class="form-control" name="factura" value="<?php echo $_POST['factura']; ?>">
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