<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Linea_Factura_Show',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Linea_Factura_Consultar{

	function __construct($arrayLinea=null,$date=null){
		if($date != null) $fecha = $date['Fecha'];
		else $fecha = null;
		$this->render($arrayLinea,$fecha);
	}

	function render($arrayLinea,$fecha){
		include_once('../header.php'); 
		
		//Include del idioma elegido, o español por defecto.
		if(isset($_SESSION['lang'])){
			if(strcmp($_SESSION['lang'],'gal')==0)
				include("../locates/Strings_GALEGO.php"); 
			else if(strcmp($_SESSION['lang'],'esp')==0)
				include("../locates/Strings_CASTELLANO.php"); 
		}else{
			include("../locates/Strings_CASTELLANO.php"); 
		}
?>	
		<script>
		//Envía el id de la factura a gestionar por post. También envía el id de la linea.
		function seleccionarLinea(id,linea,dir){
			$('#formulario2').attr('action', dir);
			$("#linea").attr("value", linea);
			$("#factura2").attr("value", id);
			$('#formulario2').submit();
		}
		
		//Confirmación de borrado.
		function seleccionarLineaBorra(id,linea,dir){
			$('#formulario2').attr('action', dir);
			$("#linea").attr("value", linea);
			$("#factura2").attr("value", id);
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
				$('#formulario2').submit();
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
					
					<div class="col-md-12"> <h4 class="text-info "><?php echo $strings['gestionar linea']; ?></h4></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para consultar y gestionar las lineas de una factura -->
					<form class="form-horizontal" id="formulario2" role="form" action="" method="POST">
					<div class="form-group">
						
						<div class="form-group">
						
						<!-- Permite añadir lineas si no se ha alcanzado la fecha de cierre -->
						<?php if($fecha > date("Y-m-d") || $fecha == null){ ?>
							<button class="btn btn-success" type="button" onclick="seleccionarLinea(<?php echo $_POST['factura']; ?>,'','LINEA_FACTURA_Controller.php?id=altaLinea')">
							   <span class="glyphicon glyphicon-plus"></span>
							</button>
						<?php } ?>
						</div>
						<div class="form-group">
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['numero linea']; ?></th>
									<th><?php echo $strings['servicio']; ?></th>
									<th><?php echo $strings['importe']; ?></th>
									<th><?php echo $strings['descripcion2']; ?></th>
								</thead><tbody>
								
								<!-- Muestra los datos de las lineas de factura -->
								<?php for($i=0; $i < count($arrayLinea); $i++){ ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $arrayLinea[$i]['Nombre']; ?></td>
									<td><?php echo $arrayLinea[$i]['Importe']; ?></td>
									<td><?php echo $arrayLinea[$i]['Descripcion']; ?></td>
									<td>
									
									<!-- Permite borrar o editar si todavía no se alcanzó la fecha de cierre de la factura -->
									<?php if($fecha > date("Y-m-d") || $fecha == null){ ?>
										<button class="btn btn-primary" type="button" onclick="seleccionarLinea(<?php echo $arrayLinea[$i]['Id_Factura']; ?>,<?php echo $arrayLinea[$i]['Id_Linea_Factura']; ?>,'LINEA_FACTURA_Controller.php?id=modificarLinea')">
										   <span class="glyphicon glyphicon-edit"></span>
										</button>
										<!-- Si solo hay una linea no permite borrar -->
										<?php if(count($arrayLinea) > 1){ ?>
										<button class="btn btn-danger" type="button" onclick="return seleccionarLineaBorra(<?php echo $arrayLinea[$i]['Id_Factura']; ?>,<?php echo $arrayLinea[$i]['Id_Linea_Factura']; ?>,'LINEA_FACTURA_Controller.php?id=bajaLinea')">
										   <span class="glyphicon glyphicon-remove"></span>
										</button>
										<?php } ?>
									<?php } ?>
									</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
							
							<!-- Input oculto con el id de la factura y servicio -->
							<input type="hidden" id="factura2" name="factura" value="">
							<input type="hidden" id="linea" name="linea" value="">
							
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