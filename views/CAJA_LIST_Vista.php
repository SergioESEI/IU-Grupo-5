<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Caja_List',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Caja_Ver{

	function __construct($array=null){
		$this->render($array);
	}

	function render($array){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo listar movimiento']; ?></title>
		
		<script>
		//Confirma borrado.
		function confirmar(id,importe,mov,dir){
			$('#formulario').attr('action', dir);
			$("#numero").attr("value", id);
			$("#importe").attr("value", importe);
			$("#movimiento").attr("value", mov);
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
				$('#formulario').submit();
			}else return false;
		}
		
		//Enviar datos edición.
		function seleccionar(id,importe,mov,comentario,fecha,dir){
			//var f = new Date(fecha);
			//var date = f.toISOString().substring(0, 10);
			$('#formulario').attr('action', dir);
			$("#numero").attr("value", id);
			$("#fecha").attr("value", fecha);
			$("#comentario").attr("value", comentario);
			$("#importe").attr("value", importe);
			$("#movimiento").attr("value", mov);
			$('#formulario').submit();
		}
		</script>	
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['listar movimiento']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Muestra el total de dinero que hay en caja -->
					<div class="form-group">
					<div class="col-sm-2">
					  <label for="nombre" class="control-label"><?php echo $strings['total caja']; ?>:</label>
					</div>
						<div class="col-sm-8">
						 <?php echo calcularTotal()." €"; ?>
						</div>
					</div>
					
					<!-- Muestra el mes actual y un mensaje de error si no tiene movimientos -->
					<?php if(isset($_POST['fecha'])){
						echo $strings['mes'].": ".date("Y, n",strtotime($_POST['fecha']));
					}else{
						echo $strings['mes'].": ". date("Y, n");
					} if($array == null) {echo "<br>".$strings['no hay'];} else{ ?>
					
					<!-- Muestra un formulario con una lista de los movimientos de caja del mes seleccionado y botones de edición y borrado -->
					<form class="form-horizontal" role="form" id="formulario" name="formulario" action="" method="POST">
						<div class="form-group">		
							<div class="form-group">
								<table class="table table-striped">
									<thead><tr> 
										<th><?php echo $strings['fecha caja']; ?></th>
										<th><?php echo $strings['tipo movimiento']; ?></th>
										<th><?php echo $strings['importe caja']; ?></th>
										<th><?php echo $strings['comentario']; ?></th>
									</thead><tbody>
										<?php for($i=0; $i < count($array); $i++){ ?>
										<tr>
											<td><?php echo $array[$i]['Fecha']; ?></td>
											<td><?php echo $array[$i]['Tipo']; ?></td>
											<td><?php echo $array[$i]['Importe']; ?></td>
											<td><?php echo $array[$i]['Comentario']; ?></td>
											<td>
												<button class="btn btn-primary" type="button" onclick="seleccionar(<?php echo "'".$array[$i]['Id_Caja']."','".$array[$i]['Importe']."','".$array[$i]['Tipo']."','".$array[$i]['Comentario']."','".$array[$i]['Fecha']."'"; ?>,'CAJA_Controller.php?id=modificarCaja')">
												   <span class="glyphicon glyphicon-edit"></span>
												</button>
												<button class="btn btn-danger" type="button" onclick="return confirmar(<?php echo "'".$array[$i]['Id_Caja']."','".$array[$i]['Importe']."','".$array[$i]['Tipo']."'"; ?>,'CAJA_Controller.php?id=bajaCaja')">
												   <span class="glyphicon glyphicon-remove"></span>
												</button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						
						<!-- Inputs hidden con los parámetros del movimiento sseleccionado -->
						<input type="hidden" id="fecha" name="fecha" value="">
						<input type="hidden" id="comentario" name="comentario" value="">
						<input type="hidden" id="numero" name="id" value="">
						<input type="hidden" id="importe" name="importe" value="">
						<input type="hidden" id="movimiento" name="movimiento" value="">
					</form>
					<?php } ?>
					
					<!-- Botón atrasar mes -->
					<div class="col-md-10">
					<form class="form-horizontal" role="form" action="CAJA_Controller.php?id=verCaja" method="POST">
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
					<form class="form-horizontal" role="form" action="CAJA_Controller.php?id=verCaja" method="POST">
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