<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si tiene permisos antes de cargar la página.
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura_Edit',$_SESSION['permisos']))){ 

//Crea la clase e instancia la función render en el constructor. 
class Factura_Editar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo modificar factura']; ?></title>
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
				  //Comprueba que la fecha sea mayor o igual a la actual.
				  var fecha = new Date(document.getElementById("fecha").value);
				  var today = new Date();
				  today.setHours(0,0,0,0);
				  if (fecha < today){
					alert('<?php echo $strings['fecha invalida']; ?>');  
					return false;    
				  }else{
					if (confirm('<?php echo $strings['confirmar modificacion']; ?>\n\n'+
						'<?php echo $strings['id factura']; ?>: '+document.getElementById("factura").value+'\n\n'+
						'<?php echo $strings['cliente']; ?>: '+document.getElementById("cliente").value+'\n\n'+
						'<?php echo $strings['fecha cierre']; ?>: '+document.getElementById("fecha").value+'\n\n'+
						'<?php echo $strings['total factura']; ?>: '+document.getElementById("total").value+'€\n')){
					   $('#formulario').submit();
					} else return false; 
				  }		  
			  } else{
				  alert('<?php echo $strings['formato fecha invalido']; ?>'); 
				  return false;
			  } 
		  } 
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
					
					<!-- Formulario para editar factura -->
					<form class="form-horizontal" role="form" id="formulario" action="FACTURA_Controller.php?id=modificarFactura" method="POST">
						<div class="form-group">
							
							<!-- Input oculto con el id de la factura -->
							<input type="hidden" id="factura" name="factura" value="<?php echo $_POST['factura']; ?>">
							
							<!-- Muestra el cliente -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['cliente']; ?>:</label>
								</div>
								<div class="col-sm-4">
									<input type="hidden" id="cliente" name="cliente" value="<?php echo $_POST['n_cliente']; ?>">
									<?php echo $_POST['n_cliente']; ?>
								</div>
							</div>
							
							<!-- Input para introducir la nueva fecha de cierre -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['fecha cierre']; ?> (mm/dd/aaaa):</label>
								</div>
								<div class="col-sm-4">
								<?php if($_POST['date'] != ''){ ?>
								  <input class="tcal" type="text" id="fecha" name="fechaN" value="<?php echo date("m/d/Y",strtotime($_POST['date'])); ?>">
								<?php }else{ ?>  
								  <input class="tcal" type="text" id="fecha" name="fechaN" value="<?php echo date("m/d/Y"); ?>">
								<?php } ?>   
								</div>
							</div>
							
							<!-- Input para modifcar el total -->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label"><?php echo $strings['total factura']; ?>:</label>
								</div>
								<div class="col-sm-4">
								<?php if($_POST['total'] != null){ ?>
								  <input type="text" class="form-control" id="total" name="totalN" value="<?php echo $_POST['total']; ?>" pattern="(\d{1,3})(\.\d{2})?" title="<?php echo $strings['error total factura']; ?>" required>
								<?php }else{ ?>  
								  <input type="text" class="form-control" id="total" name="totalN" pattern="[0-9\.]{2,6}" title="3 cifras max y 2 decimales" required>
								<?php } ?>
								</div>
							</div>
							
							<!-- Submit para modificar la factura -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="button" onclick="validaFecha()">
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