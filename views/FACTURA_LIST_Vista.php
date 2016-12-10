<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura_List',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Factura_Buscar{

	function __construct($array=null){
		$this->render($array);
	}

	function render($array){
		include_once('../header.php'); 		
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo buscar facturas']; ?></title>
		
		<script>
		//Valida el formato de la fecha.
		function validaFecha() {  
		  
		  if(document.getElementById("fecha2").value == ''){
				$('#formulario').submit();
			}else{
			  var inputText = document.getElementById("fecha2");
			  var dateformat = /^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;  
			  
			  if(inputText.value.match(dateformat)){  
				  
				  var opera1 = inputText.value.split('/');  
				  lopera1 = opera1.length;  
				   
				  if (lopera1>1){  
					var pdate = inputText.value.split('/');  
				  }
				  var mm  = parseInt(pdate[0]);  
				  var dd = parseInt(pdate[1]);  
				  var yy = parseInt(pdate[2]);  
				  
				  var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
				  if (mm==1 || mm>2){  
					if (dd>ListofDays[mm-1]){  
						alert('<?php echo $strings['formato fecha invalido']; ?>');  
						return false;  
					}  
				  }  
				  if (mm==2){  
					var lyear = false;  
					if ( (!(yy % 4) && yy % 100) || !(yy % 400)){  
						lyear = true; 
					}  
					if ((lyear==false) && (dd>=29)){  
						alert('<?php echo $strings['formato fecha invalido']; ?>');  
						return false;  
					}  
					if ((lyear==true) && (dd>29)){  
						alert('<?php echo $strings['formato fecha invalido']; ?>');  
						return false;  
					}  
				  }
				  $('#formulario').submit();	  
			  }  
			  else{  
				  alert('<?php echo $strings['formato fecha invalido']; ?>');  
				  return false;  
			  } 
			}			  
		}
		
		//Envía el id de la factura a gestionar por post.
		function seleccionar(id,dir){
			$('#formulario').attr('action', dir);
			$("#factura").attr("value", id);
			document.formulario.submit();
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
					
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar facturas']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Formulario para introducir datos a buscar -->
					<?php if(!isset($_POST['cliente'])){ ?>
					<form class="form-horizontal" role="form" id="formulario" action="FACTURA_Controller.php?id=buscarFactura" method="POST" onsubmit="return validaFecha()">
						<div class="form-group">
							
							<!-- Input para buscar clientes -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['nombre cliente']; ?>:</label>
								</div>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="cliente" pattern="[A-Za-zÁÉÍÓÚÑñáéíóú ]{2,30}" title="<?php echo $strings['error nombre cliente']; ?>">
								</div>
							</div>
							
							<!-- Input para introducir la fecha -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['fecha cierre']; ?> (mm/dd/aaaa):</label>
								</div>
								<div class="col-sm-4"> 
								  <label class='radio-inline'><input type='radio' name="fecha" value="todas" checked><?php echo $strings['todas']; ?></label><br>
								  <label class='radio-inline'><input type='radio' name="fecha" value=""><input class="tcal" type="text" id="fecha2" name="fecha2" value="<?php echo date("m/d/Y"); ?>"></label>
								</div>
							</div>
							
							<!-- Input para indicar si está cobrada -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['factura cobrada']; ?>:</label>
								</div>
								<div class="col-sm-4"> 
								  <label class='radio-inline'><input type='radio' name='pagada' value="todas" checked><?php echo $strings['todas']; ?></label>
								  <label class='radio-inline'><input type='radio' name='pagada' value="Si"><?php echo $strings['cobrada']; ?></label>
								  <label class='radio-inline'><input type='radio' name='pagada' value="No"><?php echo $strings['no cobrada']; ?></label>
								</div>
							</div>
							
							<!-- Submit para buscar cliente -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit" >
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>  
							 </div>
						</div>
					</form>
					
					<!-- Formulario que muestra las facturas según los criterios de búsqueda -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" id="formulario" name="formulario" action="" method="POST">
						<div class="form-group">
							
							<?php if($array == null){ echo $strings['no hay']; } else{ ?>
							<!-- Muestra una lista con las facturas del cliente y un botón para gestionarlas y generar pdf si está cerrada -->
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
										<?php for($i=0; $i < count($array); $i++){ ?>
										<tr>
											<td><?php echo $array[$i]['Id_Factura']; ?></td>
											<td><?php echo $array[$i]['Nombre']; ?></td>
											<td><?php echo $array[$i]['Total']; ?></td>
											<td><?php echo $array[$i]['Fecha']; ?></td>
											<td><?php echo $array[$i]['Pagada']; ?></td>
											<td><?php echo $array[$i]['Fecha_Cobro']; ?></td>
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
								<?php } ?>
								
							</div>
						</div>
					</form>
					
					<!-- Botón volver atrás -->
					<a href="FACTURA_Controller.php?id=buscarFactura" class="btn navbar-btn">
					<span style="font-size:19px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-arrow-left"></span></a>
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