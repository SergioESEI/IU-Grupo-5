<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Usuario_Editar{
	
	//Si se le pasa, crea un array con los datos del usuario.
	function __construct($datos=null){
		$this->render($datos);
	}

	function render($datos){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->	
		<title><?php echo $strings['titulo editar usuario']; ?></title>
		
		<script>
		//Compruba que el formato del DNI sea válido.
		function nif(dni) {
		  var numero
		  var letr
		  var letra
		  var expresion_regular_dni
		 
		  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
		 
		  if(expresion_regular_dni.test (dni) == true){
			 numero = dni.substr(0,dni.length-1);
			 letr = dni.substr(dni.length-1,1);
			 numero = numero % 23;
			 letra='TRWAGMYFPDXBNJZSQVHLCKET';
			 letra=letra.substring(numero,numero+1);
			if (letra!=letr.toUpperCase()) {
			   alert('<?php echo $strings['error letra dni']; ?>');
			 }
		  }else{ 
			if (dni != "")
				alert('<?php echo $strings['error dni']; ?>');
		   }
		}

		//Confirman la edición.
		function pregunta(){
			var dni = document.getElementById("dni").value;
			var grupo = document.getElementById("grupoN").value;
			
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
				'\n\n<?php echo $strings['dni']; ?>: '+dni +
				'\n<?php echo $strings['grupo']; ?>: '+grupo)){
			   document.formulario.submit();
			} else return false;
		}
		</script>

		<body>
		  <div class="row-fluid">
			<!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">
					
					<!-- Formulario para seleccionar el usuario a editar -->
					<?php if(!isset($_POST['usuario'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/USUARIO_Controller.php?id=modificarUsuario">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar usuario']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Lista los usuarios registrados -->						
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="usuario" required>
									<?php listarUsuariosModificar(); ?>
								</select>
							</div></div>
						</div>
						
						<!-- Submit para visualizar usuario a modificar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						
							</div></div>
					</form>
						
					<!-- Formulario para mostrar el usuario y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/USUARIO_Controller.php?id=modificarUsuario" onsubmit="return pregunta()">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar usuario']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Muestra los datos del usuario a editar -->
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['usuario']; ?></th>
									<th><?php echo $strings['grupo']; ?></th>
									<th><?php echo $strings['dni']; ?></th>
								</thead><tbody>
									<?php consultarUsuario($_POST['usuario']); ?>
								</tbody>
							</table>
							
							<!-- Input oculto con el usuario a modificar -->
							<input type="hidden" name="usuario" value="<?php echo $_POST['usuario']; ?>">
							<input type="hidden" name="usuarioN" value="<?php echo $_POST['usuario']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?> <?php echo $strings['campos modificar']; ?>:</label>
								</div>
							</div>
						</div>
						
						<!-- Campo password-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['password']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="password" class="form-control" name="passwordN" pattern="[A-Za-z0-9]{4,16}" title="<?php echo $strings['error password']; ?>">
							</div>
						</div>
						
						<!-- Campo grupo, si es Admin no permite modificarlo -->
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
							</div><div class="col-sm-4">
							<?php if(strcmp($_SESSION['user'],$_POST['usuario'])!= 0){
								echo "<select id='grupoN' name='grupoN'>";
								listarGrupos(); 
								echo "</select>";
							}else{ 
								echo $_SESSION['grupo'];
								echo "<input type='hidden' id='grupoN' name='grupoN' value='".$_SESSION['grupo']."'>";
							} ?>
						</div></div>
						
						<!-- Campo DNI, opcional (recupera del array el DNI si ya tenía uno asignado y lo muestra) -->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['dni opcional']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <?php if($datos['DNI'] != null){ ?>
								<input type="text" id="dni" class="form-control" name="dniN" value="<?php echo $datos['DNI']; ?>" onblur="nif(this.value)">
							  <?php }else{ ?>
								<input type="text" id="dni" class="form-control" name="dniN" onblur="nif(this.value)">
							  <?php } ?>
							</div>
						</div>
						
						<!-- Submit para editar el usuario, con confirmación -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">						
							</div></div>
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