<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_cache_limiter('public');
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura_List',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Factura_Listar{

	function __construct($array=null){
		$this->render($array);
	}

	function render($array){
		include_once('../header.php'); 		
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo ver facturas']; ?></title>
		
		<script>
		//Envía el id de la factura a gestionar por post.
		function seleccionar(id,dir){
			$('#formulario').attr('action', dir);
			$("#factura").attr("value", id);
			document.formulario.submit();
		}
		</script>
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver facturas']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Si hay facturas muestra formulario para gestionarlas, si no muestra error -->
					<?php if(isset($_POST['fecha'])){
						echo $strings['mes'].": ".date("Y, n",strtotime($_POST['fecha']));
					}else{
						echo $strings['mes'].": ".date("Y, n");
					} if($array == null) {echo "<br>".$strings['no hay'];} else{ ?>
					<form class="form-horizontal" role="form" id="formulario" name="formulario" action="FACTURA_Controller.php?id=consultarFactura" method="POST">
						<div class="form-group">
							
							<!-- Muestra una lista con las facturas del cliente y un botón para gestionarlas y generar pdf si tiene fecha de cierre -->
							<div class="form-group">
								<table class="table table-striped">
									<thead><tr> 
										<th><?php echo $strings['id factura']; ?></th>
										<th><?php echo $strings['fecha cobro']; ?></th>
										<th><?php echo $strings['factura cobrada']; ?></th>
										<th><?php echo $strings['cliente']; ?></th>
										<th><?php echo $strings['total factura']; ?></th>
										<th><?php echo $strings['fecha cierre']; ?></th>
									</thead><tbody>
									 <?php for($i=0; $i < count($array); $i++){ ?>
										<tr>
											<td><?php echo $array[$i]['Id_Factura']; ?></td>
											<td><?php echo $array[$i]['Fecha_Cobro']; ?></td>
											<td><?php echo $array[$i]['Pagada']; ?></td>
											<td><?php echo $array[$i]['Nombre']; ?></td>
											<td><?php echo $array[$i]['Total']; ?></td>
											<td><?php echo $array[$i]['Fecha']; ?></td>
											<td>
												<button class="btn btn-warning" type="button" onclick="seleccionar(<?php echo $array[$i]['Id_Factura']; ?>,'FACTURA_Controller.php?id=consultarFactura')">
												   <span class="glyphicon glyphicon-search"></span>
												</button>
												<?php if($array[$i]['Fecha'] != null){ ?>
													<input class="btn btn-info" value="<?php echo $strings['generar factura']; ?>" type="button" onclick="seleccionar(<?php echo $array[$i]['Id_Factura']; ?>,'FACTURA_Controller.php?id=generarFactura')">
												<?php } ?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								
					<!-- Input oculto con el id de la factura -->
								<input type="hidden" id="factura" name="factura" value="">				
							</div>
						</div>
					</form>
					<?php } ?>
					
					<!-- Botón atrasar mes -->
					<div class="col-md-10">
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=listarFacturas" method="POST">
						<div class="form-group">		
							<?php if(!isset($_POST['fecha'])){ ?>
								<input type="hidden" class="form-control" name="fecha" value="<?php echo date('Y-m-d',strtotime("-1 month")); ?>">
								<div class="col-sm-4"><button type="submit" class="btn btn-link btn-lg" aria-label="Left Align">
								  <span class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-left"></span>
								</button></div>
							<?php }else{ ?>
								<input type="hidden" class="form-control" name="fecha" value="<?php echo date("Y-m-d",strtotime('-1 month', strtotime($_POST['fecha']))); ?>">
								<div class="col-sm-4"><button type="submit" class="btn btn-link btn-lg" aria-label="Left Align">
								  <span class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-left"></span>
								</button></div>
						<?php } ?>
						</div>
					</form>
					</div>
					
					<!-- Botón adelantar mes -->
					<div class="col-md-2">
					<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=listarFacturas" method="POST">
						<div class="form-group">		
							<?php if(!isset($_POST['fecha'])){ ?>
								<input type="hidden" class="form-control" name="fecha" value="<?php echo date('Y-m-d',strtotime("+1 month")); ?>">
								<div class="col-sm-4"><button type="submit" class="btn btn-link btn-lg" aria-label="Left Align">
								  <span class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-right"></span>
								</button></div>
							<?php }else{ ?>
								<input type="hidden" class="form-control" name="fecha" value="<?php echo date("Y-m-d",strtotime('+1 month', strtotime($_POST['fecha']))); ?>">
								<div class="col-sm-4"><button type="submit" class="btn btn-link btn-lg" aria-label="Left Align">
								  <span class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-right"></span>
								</button></div>
							<?php } ?>
						</div>
					</form>
					</div>
								
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