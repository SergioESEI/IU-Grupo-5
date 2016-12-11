<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],"Secretario") == 0) ){ 

//Crea la clase e instancia la función render en el constructor. 
class Alumno_Buscar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<title><?php echo $strings['buscarAlumno']; ?></title>

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
				alert('<?php echo $strings['error dniA']; ?>');
		   }
		}
		</script>
                
		<body>

		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar alumno']; ?></h2></div>
						<div class="col-md-12"><hr></div>
					</div>
					
					<!-- Formulario que recoge el alumno a buscar -->
					<?php if(!isset($_POST['alumno'])){ ?>
					<form class="form-horizontal" role="form" action="../controllers/ALUMNO_Controller.php?id=buscarAlumno" method="POST">
						
						<!-- Campo dni alumno-->
						<div class="form-group">
                                                        <div class="col-sm-4">
                                                          <label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" name="alumno" onblur="nif(this.value)" title="<?php echo $strings['error dniA']; ?>" required>
                                                        </div>
                                                </div>
						
						<!-- Submit que envía los datos para buscar el alumno -->
						 <div class="form-group">
							  <div class="col-sm-4"></div>
							  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
							  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
						 </div>
					</form>
					
					<?php }else{ ?>
					<!-- Lista los datos del alumno -->	
					<table class="table table-striped">
						<thead><tr> 
							<th><?php echo $strings['dni']; ?></th>
                                                        <th><?php echo $strings['apellidos']; ?></th>
                                                        <th><?php echo $strings['nombre']; ?></th>
                                                        <th><?php echo $strings['direccion']; ?></th>
                                                        <th><?php echo $strings['email']; ?></th>
                                                        <th><?php echo $strings['nacimiento']; ?></th>
                                                        <th><?php echo $strings['profesion']; ?></th> 
                                                        <th><?php echo $strings['observaciones']; ?></th>
						</thead><tbody>
							<?php consultarAlumno($_POST['alumno']); ?>
						</tbody>
					</table>
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