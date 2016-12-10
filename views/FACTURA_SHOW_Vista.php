<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura_Show',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Factura_Consultar{

	function __construct($array=null){
		$this->render($array);
	}

	function render($array){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo gestionar factura2']; ?></title>
		
		<script>
		//Envía el id de la factura a gestionar por post y el action según sea editar o borrar.
		function seleccionar(id,dir){
			$('#formulario').attr('action', dir);
			$("#factura").attr("value", id);
			$('#formulario').submit();
		}
		//Incluye fecha.
		function seleccionar2(id,dir){
			var fecha = new Date("<?php echo $array['Fecha']; ?>");
			var date = fecha.toISOString().substring(0, 10);
			$('#formulario').attr('action', dir);
			$("#factura").attr("value", id);
			$("#date").attr("value", date);
			$('#formulario').submit();
		}
		
		//Confirma borrado.
		function seleccionarBorra(id,dir){
			$('#formulario').attr('action', dir);
			$("#factura").attr("value", id);
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
				$('#formulario').submit();
			}else return false;
		}
		</script>
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['gestionar factura']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para consultar y gestionar una factura -->
					<form class="form-horizontal" id="formulario" role="form" action="" method="POST">
					<div class="form-group">
						
						<!-- Muestra los datos de la factura -->
						<div class="form-group">
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['id factura']; ?></th>
									<th><?php echo $strings['cliente']; ?></th>
									<th><?php echo $strings['total factura']; ?></th>
									<th><?php echo $strings['fecha cierre']; ?></th>
									<th><?php echo $strings['factura cobrada']; ?></th>
									<th><?php echo $strings['fecha cobro']; ?></th>
								</thead><tbody>
									<tr>
										<td><?php echo $array['Id_Factura']; ?></td>
										<td><?php echo $array['Nombre']; ?></td>
										<td><?php echo $array['Total']; ?></td>
										<td><?php echo $array['Fecha']; ?></td>
										<td><?php echo $array['Pagada']; ?></td>
										<td><?php echo $array['Fecha_Cobro']; ?></td>
										<td>
										
										<!-- Input para marcar la factura como cobrada, activo cuando se supera la fecha de cierre -->
										<?php if($array['Fecha'] != null && $array['Fecha'] <= date("Y-m-d") && $array['Pagada'] == 'No'){ ?>
											<input class="btn btn-primary" value="<?php echo $strings['cobrar']; ?>" type="button" onclick="seleccionar2(<?php echo $array['Id_Factura']; ?>,'FACTURA_Controller.php?id=cobrarFactura')">
										<?php } ?>
										
										<!-- Permite editar (total y fecha cierre) o borrar la factura mientras no se haya cobrado -->
										<?php if($array['Pagada'] == 'No' && $array['Fecha'] != null && $array['Total'] != '0'){ ?> 	
											<button class="btn btn-primary" type="button" onclick="seleccionar2(<?php echo "'".$array['Id_Factura']."'"; ?>,'FACTURA_Controller.php?id=modificarFactura')">
											   <span class="glyphicon glyphicon-edit"></span>
											</button>
										<?php }else if($array['Fecha'] == null && $array['Total'] != '0'){ ?> 
											<button class="btn btn-primary" type="button" onclick="seleccionar(<?php echo "'".$array['Id_Factura']."'"; ?>,'FACTURA_Controller.php?id=modificarFactura')">
											   <span class="glyphicon glyphicon-edit"></span>
											</button>
										<?php } ?>
										<?php if($array['Pagada'] == 'No'){ ?> 		
											<button class="btn btn-danger" type="button" onclick="return seleccionarBorra(<?php echo "'".$array['Id_Factura']."'"; ?>,'FACTURA_Controller.php?id=bajaFactura')">
											   <span class="glyphicon glyphicon-remove"></span>
											</button>
										<?php } ?>
										</td>	
									</tr>
								</tbody>
							</table>
							
							<!-- Input oculto con el id de la factura, nombre del cliente, total y la fecha -->
							<input type="hidden" name="n_cliente" value="<?php echo $array['Nombre']; ?>">
							<input type="hidden" id="factura" name="factura" value="<?php echo $array['Id_Factura']; ?>">
							<input type="hidden" id="date" name="date" value="">
							<input type="hidden" id="total" name="total" value="<?php echo $array['Total']; ?>">
													
						</div>					 
					</div>
				 </form>
				 
				 <!-- Botón volver atrás -->
				<form class="form-horizontal" role="form" action="FACTURA_Controller.php?id=buscarFactura" method="POST">
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