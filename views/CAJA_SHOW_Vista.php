<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Caja_Show',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Caja_Consultar{

	function __construct($array=null){
		$this->render($array);
	}

	function render($array){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo consultar movimiento']; ?></title>
		
		<script>
		//Valida el formato de la fecha.
		function validaFecha() {  
		  
		  if(document.getElementById("fecha").value == ''){
				$('#formulario').submit();
			}else{
			  var inputText = document.getElementById("fecha");
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
		
		//Confirma borrado.
		function confirmar(id,importe,mov,dir){
			$('#formulario2').attr('action', dir);
			$("#numero").attr("value", id);
			$("#importe").attr("value", importe);
			$("#movimiento").attr("value", mov);
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
				$('#formulario2').submit();
			}else return false;
		}
		
		//Enviar datos edición.
		function seleccionar(id,importe,mov,comentario,fecha,dir){
			
			$('#formulario2').attr('action', dir);
			$("#numero").attr("value", id);
			$("#fecha").attr("value", fecha);
			$("#comentario").attr("value", comentario);
			$("#importe").attr("value", importe);
			$("#movimiento").attr("value", mov);
			$('#formulario2').submit();
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
					
					<!-- Si todavía no hay fecha carga el formulario para elegir fecha -->
					<?php if(!isset($_POST['movimiento'])){ ?>
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar movimiento']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<form class="form-horizontal" role="form" id="formulario" action="CAJA_Controller.php?id=consultarCaja" method="POST">
						<div class="form-group">
							
							<!-- Input para introducir la fecha -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['fecha caja']; ?> (mm/dd/aaaa):</label>
								</div>
								<div class="col-sm-4"> 
								  <input class="tcal" type="text" id="fecha" name="fecha" value="<?php echo date("m/d/Y"); ?>">
								</div>
							</div>
							
							<!-- Input para introducir tipo de movimiento -->
							<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['tipo movimiento']; ?>:</label>
							</div>
								<div class="col-sm-4">
								<label class="radio-inline"><input type="radio" name="movimiento" value="todos" checked><?php echo $strings['todos']; ?></label>
								<label class="radio-inline"><input type="radio" name="movimiento" value="Ingreso"><?php echo $strings['ingreso caja']; ?></label>
								<label class="radio-inline"><input type="radio" name="movimiento" value="Pago"><?php echo $strings['pago caja']; ?></label>
								</div>
							</div>
							
							<!-- Submit para enviar la fecha -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="Buscar" type="button" onclick="validaFecha()">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
					</form>
					
					<!-- Si hay fecha carga los movimientos de caja de esa fecha -->
					<?php }else{ ?>
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['consultar movimiento']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					
					<!-- Muestra el total de dinero que hay en caja -->
					<div class="form-group">
					<div class="col-sm-2">
					  <label for="nombre" class="control-label"><?php echo $strings['total caja']; ?>:</label>
					</div>
						<div class="col-sm-10">
						 <?php echo calcularTotal()." €"; ?>
						</div>
					</div>
					
					<?php if($array == null){ echo $strings['no hay']."<br>"; } else { ?>
					<!-- Carga una tabla en un formulario con opción a borrar y editar movimientos -->
					<form class="form-horizontal" role="form" id="formulario2" name="formulario2" action="" method="POST">
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
						
						<!-- Inputs hidden con los atributos del movimiento seleccionado -->
						<input type="hidden" id="fecha" name="fecha" value="">
						<input type="hidden" id="comentario" name="comentario" value="">
						<input type="hidden" id="numero" name="id" value="">
						<input type="hidden" id="importe" name="importe" value="">
						<input type="hidden" id="movimiento" name="movimiento" value="">
					</form>
					<?php } ?>
					
					<!-- Botón volver atrás -->
					 <a href="CAJA_Controller.php?id=consultarCaja" class="btn navbar-btn">
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