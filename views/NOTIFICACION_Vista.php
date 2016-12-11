<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],"Secretario") == 0) ){ 

//Crea la clase e instancia la función render en el constructor. 
class Notificacion_Enviar{
	
	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->	
		<title><?php echo $strings['titulo enviar notificacion']; ?></title>
		

		<body>
		  <div class="row-fluid">
			<!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">
					
					<!-- Formulario para los campos de la notificacion -->
                                        <form class="form-horizontal" role="form" action="../controllers/NOTIFICACION_Controller.php" method="POST">
                                                <div class="form-group">
                                                        <div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nueva notificacion']; ?></h2></div>
                                                        <div class="col-md-12"><hr></div>
                                                        
                                                        <input type="hidden" name="notificacion" value="<?php echo $_POST['alumno']; ?>">
                                                        
                                                        <!-- Campo asunto -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['asunto']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="asunto" pattern="[0-9A-Za-z ]{3,50}" title="<?php echo $strings['error asunto']; ?>" required>
                                                                </div>
                                                        </div>

                                                        <!-- Campo cuerpo -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['cuerpo']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="text" class="form-control" name="cuerpo" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,500}" title="<?php echo $strings['error cuerpo']; ?>" required>
                                                                </div>
                                                        </div>
                                                        
                                                        <!-- Submit que envía los datos de la notificacion -->
                                                         <div class="form-group">
                                                                  <div class="col-sm-4"></div>
                                                                  <div class="col-sm-4">
                                                                        <input class="btn btn-primary" value="<?php echo $strings['enviar']; ?>" type="submit">
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