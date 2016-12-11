<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Buscar{

		function __construct($datos=null){
			$this->render($datos);
		}

		function render($datos){
			include_once('../header.php'); 
			?>
			<title><?php echo $strings['titulo mostrar trabajador']; ?></title>
			



			<body>


				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
								
								<!-- Formulario que recoge el trabajador a buscar -->
								<?php if(!isset($_GET['buscar'])){ ?>

								<div class="form-group">
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar trabajador']; ?></h2></div>
									<div class="col-md-12"><hr></div>
									<form class="form-horizontal" role="form" action="../controllers/TRABAJADOR_Controller.php?id=buscarTrabajador&buscar=ok" method="POST">
										
										<!-- Campo dni-->
										<div class="form-group">
											<div class="col-sm-4">
												<label for="nombre" class="control-label"><?php echo $strings['dni trabajador']; ?>:</label>
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="dni"  title="<?php echo $strings['error usuario']; ?>" >
											</div>
										</div>


										<!-- Campo Nombre -->
										<div class="form-group">
											<div class="col-sm-4">
												<label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="nombre"  title="<?php echo $strings['error trabajador']; ?>" >
											</div>
										</div>
										

										<!-- Campo Apellidos -->
										<div class="form-group">
											<div class="col-sm-4">
												<label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="apellidos"  title="<?php echo $strings['error trabajador']; ?>" >
											</div>
										</div>

								<!-- Campo Foto de perfil -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['fotoperfil'];?>:</label>
									</div>
									<div class="col-sm-4">
										<input name="fotoperfil" type="file" class="control-label" title="<?php echo $strings['error trabajador']; ?>" >
									</div>
								</div>

								<!-- Campo Direccion -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="direccion"  title="<?php echo $strings['error trabajador']; ?>" >
									</div>
								</div>

								<!-- Campo Email -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php echo $strings['error trabajador']; ?>" >
									</div>
								</div>

								<!-- Campo Fecha Nacimiento -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['fechanac']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input class = "tcal" type = "date" name="fechanac"  title="<?php echo $strings['error trabajador']; ?>" >
									</div>
								</div>


								<!-- Campo Tipo de Empleado-->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<select name="tipoemp" >
											<option value="administrador"><?php echo $strings['administrador'];?></option>;
											<option value="secretario"><?php echo $strings['secretario'];?></option>;
											<option value="monitor"><?php echo $strings['monitor'];?></option>;
											<option value="fisioterapeuta"><?php echo $strings['fisioterapeuta'];?></option>;
											<option value="cafeteria"><?php echo $strings['cafeteria'];?></option>;
											<option value="limpieza"><?php echo $strings['limpieza'];?></option>;
											<option value="otros"><?php echo $strings['otros'];?></option>;
										</select>
									</div>
								</div>
								
								
								
								<!-- Campo Observaciones -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<textarea name="observaciones" rows="10" cols="40"></textarea>
									</div>
								</div>



								<!-- Campo Numero de Cuenta -->

								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['numerocuenta']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="numerocuenta"  title="<?php echo $strings['error trabajador']; ?>" >
									</div>
								</div>


								<!-- Campo Telefono -->
								
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['telefono']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="telefono"  title="<?php echo $strings['error trabajador']; ?>">
									</div>
								</div>

								<!-- Campo Externo-->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['externo']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="radio" name="externo" value="0" autofocus >Externo
										<br>
										<input type="radio" name="externo" value="1">No externo
									</div>
								</div>
								

										
										<!-- Submit que envía los datos para buscar el trabajador -->
										<div class="form-group">
											<div class="col-sm-4"></div>
											<div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
												<input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
											</div>
										</form>

										
										<?php }else{ ?>
										
										<form class="form-horizontal" role="form">
										<div class="form-group"></div>
											<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['buscar trabajador']; ?></h2></div>
											<div class="col-md-20"><hr></div>
											

											<br>



											<!-- Campo Nombre -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="nombre" value="<?php echo $datos['Nombre']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
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
													<?php if($datos['Apellidos'] != null){ ?>
													<input type="text" class="form-control" name="apellidosN" value="<?php echo $datos['Apellidos']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="apellidosN"  title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
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
													<?php if($datos['Direccion'] != null){ ?>
													<input type="text" class="form-control" name="direccionN" value="<?php echo $datos['Direccion'];?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="direccionN"  title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
												</div>
											</div>

											<!-- Campo Email -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Email'] != null){ ?>
													<input type="text" class="form-control" name="emailN" value="<?php echo $datos['Email'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="emailN" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
												</div>
											</div>

											<!-- Campo Fecha Nacimiento -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['fechanac']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Email'] != null){ ?>
													<input type="text" class="form-control" name="fechanacN" value="<?php echo $datos['Fecha_Nacimiento'];?>"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="fechanacN" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
												</div>
											</div>
											<!-- Campo DNI-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['DNI'] != null){ ?>
													<input type="text" id="dni" class="form-control" name="dniN" value="<?php echo $datos['DNI']; ?>" onblur="nif(this.value)" readonly>
													<?php }else{ ?>
													<input type="text" id="dni" class="form-control" name="dniN" onblur="nif(this.value)" readonly>
													<?php } ?>
													
												</div>
											</div>
											

											<!-- Campo Tipo de Empleado-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Tipo_Empleado'] != null){ ?>
													<input type="text" class="form-control" name="tipoemp" value="<?php echo $datos['Tipo_Empleado']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="tipoemp"  title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
												</div>
											</div>
											
											
											
											<!-- Campo Observaciones -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Observaciones'] != null){ ?>
													<textarea name="observacionesN" readonly rows="10" cols="40"><?php echo $datos['Observaciones']; ?></textarea>
													<?php }else{ ?>
													<textarea name="observacionesN" readonly rows="10" cols="40"></textarea>
													<?php } ?>
												</div>
											</div>



											<!-- Campo Numero de Cuenta -->

											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['numerocuenta']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Numero_Cuenta'] != null){ ?>
													<input type="text" class="form-control" name="numerocuentaN"  value="<?php echo $datos['Numero_Cuenta']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="numerocuentaN"  title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
												</div>
											</div>

											

										
											<!-- Campo Externo-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['externo']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="externoN"  value="<?php echo $datos['Externo']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
							
										</div>
									</div>
								</div>
							</div>
						</body>
						<?php 
					}
					}
				}
			}else
			echo "Permiso denegado.";
			?>