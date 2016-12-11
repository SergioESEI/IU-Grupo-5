<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Borrar_Confirmar{

		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
			include_once('../header.php'); 
			?>
			<title><?php echo $strings['titulo borrar trabajador']; ?></title>

			<body>

				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
										
										<form class="form-horizontal" role="form" action="../controllers/TRABAJADOR_Controller.php?id=bajaTrabajador&id2=<?php echo $datos['DNI'];?> &confirm=ok" method="POST" enctype="multipart/form-data" >
										<div class="form-group">

											<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['confirmar datos']; ?></h2></div>
											<div class="col-md-20"><hr></div>
											

											<!-- Campo DNI-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
												</div>
												<div class="col-sm-4">
													
													<input type="text" id="dni" class="form-control" name="dni" value="<?php echo $datos['DNI']; ?>" readonly>
													
												</div>
											</div>

											<!-- Campo Nombre -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="nombre" value="<?php echo $datos['Nombre']; ?>" title="<?php echo $strings['error nombre']; ?>" readonly>
												</div>
											</div>
											

											<!-- Campo Apellidos -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="apellidos" value="<?php echo $datos['Apellidos']; ?>" title="<?php echo $strings['error apellidos']; ?>" readonly>
												
												</div>
											</div>
											<br>

											<!-- Campo Foto de perfil -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['fotoperfil'];?>:</label>
												</div>
												<div class="col-sm-4">
													<img src="<?php echo $datos['Url_Foto']; ?>">
												</div>
											</div>


											<!-- Campo Direccion -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
												</div>
												<div class="col-sm-4">

													<input type="text" class="form-control" name="direccion" value="<?php echo $datos['Direccion'];?>" title="<?php echo $strings['error direccion']; ?>" readonly>
								
												</div>
											</div>

											<!-- Campo Email -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="email" value="<?php echo $datos['Email'];?>"  title="<?php echo $strings['error email']; ?>" readonly>
												</div>
											</div>

											<!-- Campo Fecha Nacimiento -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['fechanac']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="fechanac" value="<?php echo $datos['Fecha_Nacimiento'];?>"  title="<?php echo $strings['error fecha nacimiento']; ?>" readonly>	
												</div>
											</div>

											

											<!-- Campo Tipo de Empleado-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
												</div>
												<div class="col-sm-4">
												
													<input type="text" class="form-control" name="tipoemp" value="<?php echo $datos['Tipo_Empleado']; ?>" title="<?php echo $strings['error tipo empleado']; ?>" readonly>
												
												</div>
											</div>
											
											
											
											<!-- Campo Observaciones -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
												</div>
												<div class="col-sm-4">
											
													<textarea name="observaciones" readonly rows="10" cols="40"><?php echo $datos['Observaciones']; ?></textarea>
												
												</div>
											</div>



											<!-- Campo Numero de Cuenta -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['numerocuenta']; ?>:</label>
												</div>
												<div class="col-sm-4">
										
													<input type="text" class="form-control" name="numerocuenta"  value="<?php echo $datos['Numero_Cuenta']; ?>" title="<?php echo $strings['error numero cuenta']; ?>" readonly>
												
												</div>
											</div>

											<!-- Campo Telefono -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['telefono']; ?>:</label>
												</div>
												<div class="col-sm-4">
										
													<input type="text" class="form-control" name="telefono"  value="<?php echo $datos['Telefono']; ?>" title="<?php echo $strings['error telefono']; ?>" readonly>
												
												</div>
											</div>


											<!-- Campo Externo-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['externo']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="externo"  value="<?php if($datos['Externo'] == '1'){ echo 'Externo'; }else{echo 'Interno';} ?>" title="<?php echo $strings['error externo']; ?>" readonly>
													
												</div>
											</div>
											

											<!-- Submit que envía los datos para crear el trabajador -->
											<div class="form-group">
												<div class="col-sm-4"></div>
												<div class="col-sm-4">
													<input class="btn btn-primary" value="<?php echo $strings['confirmar']; ?>" type="submit">
													<input type="button" class="btn btn-default" onclick="history.back()" value="<?php echo $strings['volver atras'];?>" name="volver atrás">
												</div>
											</div>
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