<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],"Secretario") == 0) ){ 

//Crea la clase e instancia la función render en el constructor. 
class Alumno_Crear{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo añadir alumno']; ?></title>
		
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
		</script>
		</script>
		
		<body>
		<!-- Include del menú-->
		  <div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
							
						<!-- Formulario para añadir alumno -->
						<form class="form-horizontal" role="form" action="../controllers/ALUMNO_Controller.php?id=altaAlumno" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo alumno']; ?></h2></div>
								<div class="col-md-12"><hr></div>
								
                                                                <!-- Campo DNI -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
									</div>
									<div class="col-sm-4">
                                                                            <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Za-z]{1}" onblur="nif(this.value)" title="<?php echo $strings['error dniA']; ?>" required>
									</div>
								</div>
                                                                
								<!-- Campo nombre -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="nombre" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,50}" title="<?php echo $strings['error nombreA']; ?>" required>
									</div>
								</div>
                                                                
                                                                <!-- Campo apellidos -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="apellidos" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,70}" title="<?php echo $strings['error apellidosA']; ?>" required>
									</div>
								</div>
                                                                
                                                                <!-- Campo direccion -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="direccion" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ\. ]{3,100}" title="<?php echo $strings['error direccionA']; ?>" required>
									</div>
								</div>
                                                                
                                                                <!-- Campo email -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="email" class="form-control" name="email" title="<?php echo $strings['error emailA']; ?>" required>
									</div>
								</div>
                                                                
                                                                <!-- Campo fecha de nacimiento -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['nacimiento']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="date" class="form-control" name="nacimiento" title="<?php echo $strings['error nacimientoA']; ?>" required>
									</div>
								</div>
                                                                
                                                                <!-- Campo profesion -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['profesion']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="profesion" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,50}" title="<?php echo $strings['error profesionA']; ?>" required>
									</div>
								</div>
                                                                
                                                                <!-- Campo observaciones -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="observaciones" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ\. ]{3,500}" title="<?php echo $strings['error observacionesA']; ?>" required>
									</div>
								</div>  
								
								<!-- Submit que envía los datos para crear el alumno -->
								 <div class="form-group">
									  <div class="col-sm-4"></div>
									  <div class="col-sm-4">
                                                                                <input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
                                                                                <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
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
