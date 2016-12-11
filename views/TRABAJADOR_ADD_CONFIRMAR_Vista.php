<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Alta_Confirmar{

		function __construct($trabajador=null){
			$this->render($trabajador);
		}

		function render($trabajador){
			include_once('../header.php'); 
			?>
			<title><?php echo $strings['titulo añadir trabajador']; ?></title>

			<body>

				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
										
										<form class="form-horizontal" role="form" action="../controllers/TRABAJADOR_Controller.php?id=altaTrabajador&confirm=ok" method="POST" enctype="multipart/form-data" >
										<div class="form-group">

											<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['confirmar datos']; ?></h2></div>
											<div class="col-md-20"><hr></div>
											

											<input type="hidden" name="imagen" value="<?php echo $trabajador->url_Foto; ?>">
											<!-- Campo Nombre -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="nombre" value="<?php echo $trabajador->nombre; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>
											

											<!-- Campo Apellidos -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="apellidos" value="<?php echo $trabajador->apellidos; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>
											

											<!-- Campo Foto de perfil -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['fotoperfil'];?>:</label>
												</div>
												<div class="col-sm-4">
													<img src="<?php echo $trabajador->url_Foto; ?>">
												</div>
											</div>


											<!-- Campo Direccion -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
												</div>
												<div class="col-sm-4">

													<input type="text" class="form-control" name="direccion" value="<?php echo $trabajador->direccion;?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
								
												</div>
											</div>

											<!-- Campo Email -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="email" value="<?php echo $trabajador->email;?>"  title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>

											<!-- Campo Fecha Nacimiento -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['fechanac']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="fechanac" value="<?php echo $trabajador->fechaNac;?>"  title="<?php echo $strings['error trabajador']; ?>" readonly>	
												</div>
											</div>

											<!-- Campo DNI-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
												</div>
												<div class="col-sm-4">
													
													<input type="text" id="dni" class="form-control" name="dni" value="<?php echo $trabajador->dni; ?>" onblur="nif(this.value)" readonly>
													
												</div>
											</div>
											

											<!-- Campo Tipo de Empleado-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
												</div>
												<div class="col-sm-4">
												
													<input type="text" class="form-control" name="tipoemp" value="<?php echo $trabajador->tipoEmp; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>
											
											
											
											<!-- Campo Observaciones -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
												</div>
												<div class="col-sm-4">
											
													<textarea name="observaciones" readonly rows="10" cols="40"><?php echo $trabajador->observaciones; ?></textarea>
												
												</div>
											</div>



											<!-- Campo Numero de Cuenta -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['numerocuenta']; ?>:</label>
												</div>
												<div class="col-sm-4">
										
													<input type="text" class="form-control" name="numerocuenta"  value="<?php echo $trabajador->numeroCuenta; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>

											<!-- Campo Telefono -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['telefono']; ?>:</label>
												</div>
												<div class="col-sm-4">
										
													<input type="text" class="form-control" name="telefono"  value="<?php echo $trabajador->telefono; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>


											<!-- Campo Externo-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['externo']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="externo"  value="<?php if($trabajador->externo == 'externo'){ echo '1'; }else{echo '0';} ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>
											

											<!-- Submit que envía los datos para crear el trabajador -->
											<div class="form-group">
												<div class="col-sm-4"></div>
												<div class="col-sm-4">
													<input class="btn btn-primary" value="<?php echo $strings['confirmar']; ?>" type="submit">
													<input type="button" class="btn btn-default" onclick="history.back()" name="volver atras" value="<?php echo $strings['volver atras'];?>">
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