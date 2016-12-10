<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Editar_Confirmar{

		function __construct($trabajador,$id2){
			$this->render($trabajador,$id2);
		}

		function render($trabajador,$id2){
			include_once('../header.php'); 
			?>
			<title><?php echo $strings['titulo modificar trabajador']; ?></title>

			<body>

				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
										
										<form class="form-horizontal" role="form" name="formulario" action="../controllers/TRABAJADOR_Controller.php?id=modificarTrabajador&id2=<?php echo $id2;?>&confirm=ok" method="POST" >
										<div class="form-group">

											<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['buscar trabajador']; ?></h2></div>
											<div class="col-md-20"><hr></div>
											<br>
											<input type="hidden" name="dniN" value="<?php echo $_GET['id2']; ?>">
											<input type="hidden" name="dni" value="<?php echo $_GET['id2']; ?>">

											<!-- Campo DNI-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
												</div>
												<div class="col-sm-4">
													
													<input type="text" id="dni" class="form-control" name="dniN" value="<?php echo $trabajador->dni; ?>" readonly>
													
												</div>
											</div>

											<!-- Campo Nombre -->
											<div class="form-horizontal">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="nombreN" value="<?php echo $trabajador->nombre; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>
											<br>
											<br>
											<br>

											<!-- Campo Apellidos -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="apellidosN" value="<?php echo $trabajador->apellidos; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>
											<br>

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

													<input type="text" class="form-control" name="direccionN" value="<?php echo $trabajador->direccion;?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
								
												</div>
											</div>

											<!-- Campo Email -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="emailN" value="<?php echo $trabajador->email;?>"  title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>

											<!-- Campo Fecha Nacimiento -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['fechanac']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="fechanacN" value="<?php echo $trabajador->fechaNac;?>"  title="<?php echo $strings['error trabajador']; ?>" readonly>	
												</div>
											</div>

											

											<!-- Campo Tipo de Empleado-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
												</div>
												<div class="col-sm-4">
												
													<input type="text" class="form-control" name="tipoempN" value="<?php echo $trabajador->tipoEmp; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>
											
											
											
											<!-- Campo Observaciones -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
												</div>
												<div class="col-sm-4">
											
													<textarea name="observacionesN" readonly rows="10" cols="40"><?php echo $trabajador->observaciones; ?></textarea>
												
												</div>
											</div>



											<!-- Campo Numero de Cuenta -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['numerocuenta']; ?>:</label>
												</div>
												<div class="col-sm-4">
										
													<input type="text" class="form-control" name="numerocuentaN"  value="<?php echo $trabajador->numeroCuenta; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>

											<!-- Campo Telefono -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['telefono']; ?>:</label>
												</div>
												<div class="col-sm-4">
										
													<input type="text" class="form-control" name="telefonoN"  value="<?php echo $trabajador->telefono; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>


											<!-- Campo Externo-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['externo']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php 

														if($trabajador->externo == 0){?>
														<input type="radio" readonly name="externoN" value="0" disabled checked><?php echo $strings['externo'];?>
														<br>
														<input type="radio" readonly name="externoN" value="1" disabled><?php echo $strings['interno'];?>
														<?php }else{?>
														<input type="radio" readonly name="externoN" value="0" disabled><?php echo $strings['externo'];?>
														<br>
														<input type="radio" readonly name="externoN" value="1" disabled checked><?php echo $strings['interno'];?>
														<?php }?>
													
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