<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Evento_Crear{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>		
		<!-- Título de la página -->
		<title><?php echo $strings['titulo añadir evento']; ?></title>

		  <body>
			<!-- Include del menú-->
			  <div class="row-fluid">
				<?php include_once('menu.php'); ?>
				<div class="col-sm-10 text-left">
					<div class="section-fluid">
					  <div class="container-fluid">
								
						<!-- Formulario para añadir funcionalidad-->
						<form class="form-horizontal" role="form" action="../controllers/EVENTO_Controller.php?id=altaEvento" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

								<!-- Campo Id_evento-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['Id_evento']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="Id_evento" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error Id_evento']; ?>" required>
									</div>
								</div>
								
								 <!-- Campo Descripcion-->
				                <div class="form-group">
				                  <div class="col-sm-4">
				                    <label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
				                  </div>
				                  <div class="col-sm-4">
				                    <input type="text" class="form-control" name="descripcion" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error direccion']; ?>" required>
				                  </div>
				                </div>
								
								<!-- Campo nombre-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="nombre" pattern="/^\s*([\pL\w\s]+)\s*" title="<?php echo $strings['error nombre']; ?>" required>
									</div>
								</div>

				               

								<!-- Submit que envía los datos para crear el usuario -->
								 <div class="form-group">
									  <div class="col-sm-4"></div>
									  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
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