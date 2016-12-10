<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Editar{

		function __construct($datos=null){
			$this->render($datos);
		}

		function render($datos){
			require_once('../header.php'); 
			?>
			<!-- Título de la página -->	
			<title><?php echo $strings['titulo modificar trabajador']; ?></title>


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
			var dni = document.getElementById("dniN").value;
			var nombre = document.getElementById("nombreN").value;
			var apellidos = document.getElementById("apellidosN").value;
			var direccion = document.getElementById("direccionN").value;
			var email = document.getElementById("emailN").value;
			var fechaNac = document.getElementById("fechanacN").value;
			var observaciones = document.getElementById("observacionesN").value;
			var numeroCuenta = document.getElementById("numerocuentaN").value;
			var horasExtra = document.getElementById("horasextraN").value;
			var tipoEmp = document.getElementById("tipoempN").value;
			var externo = document.getElementById("externoN").value;
			
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
				'\n\n<?php echo $strings['dni']; ?>: '+dni +
				'\n<?php echo $strings['nombre']; ?>: '+nombre+
				'\n<?php echo $strings['apellidos']; ?>: '+apellidos+
				'\n<?php echo $strings['direccion']; ?>: '+direccion+
				'\n<?php echo $strings['email']; ?>: '+email+
				'\n<?php echo $strings['fechanac']; ?>: '+fechaNac+
				'\n<?php echo $strings['observaciones']; ?>: '+observaciones+
				'\n<?php echo $strings['numerocuenta']; ?>: '+numeroCuenta+
				'\n<?php echo $strings['horasextra']; ?>: '+horasExtra+
				'\n<?php echo $strings['tipoEmp']; ?>: '+tipoEmp+
				'\n<?php echo $strings['externo']; ?>: '+externo)){
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
						
						<!-- Formulario para seleccionar el trabajador a editar -->
						<?php if(!isset($_GET['id2'])){ ?>
						<!-- Lista los trabajadores -->
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar trabajador']; ?></h2></div>
							<div class="col-md-12"><hr></div>
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['dni']; ?></th>
									<th><?php echo $strings['nombre']; ?></th>
									<th><?php echo $strings['apellidos']; ?></th>
									<th><?php echo $strings['tipoemp']; ?></th>
								</thead><tbody>
								<?php verTrabajadoresModificar(); ?>
							</tbody>
						</table>
					</div>
					
					<!-- Formulario para mostrar el trabajador y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/TRABAJADOR_Controller.php?id=modificarTrabajador&id2=<?php echo $_GET['id2'];?>" enctype="multipart/form-data" onsubmit="return pregunta()">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar trabajador']; ?></h2></div>
							<div class="col-md-12"><hr></div>
							
							<!-- Muestra los datos del trabajador a editar -->
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['dni']; ?></th>
									<th><?php echo $strings['nombre']; ?></th>
									<th><?php echo $strings['apellidos']; ?></th>
									<th><?php echo $strings['email']; ?></th>
								</thead><tbody>
								<?php consultarTrabajador($_GET['id2']); ?>
							</tbody>
						</table>
						
						<!-- Input oculto con el trabajador a modificar -->
						<input type="hidden" name="dni" value="<?php echo $_GET['id2']; ?>">
						<input type="hidden" name="dniN" value="<?php echo $_GET['id2']; ?>">
						<div class="form-group">
							<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
							</div>
						</div>
					</div>

					<!-- Campo DNI-->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<?php if($datos['DNI'] != null){ ?>
							<input type="text" id="dni" class="form-control" name="dniN" value="<?php echo $datos['DNI']; ?>" onblur="nif(this.value)">
							<?php }else{ ?>
							<input type="text" id="dni" class="form-control" name="dniN" onblur="nif(this.value)">
							<?php } ?>
							
						</div>
					</div>
					
					
					<!-- Campo Nombre -->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<?php if($datos['Nombre'] != null){ ?>
							<input type="text" id="nombreN" class="form-control" name="nombreN" value="<?php echo $datos['Nombre']; ?>" title="<?php echo $strings['error trabajador']; ?>" required>
							<?php }else{ ?>
							<input type="text" id="nombreN" class="form-control" name="nombreN"  title="<?php echo $strings['error trabajador']; ?>" required>
							<?php } ?>
						</div>
					</div>
					

					<!-- Campo Apellidos -->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<?php if($datos['Apellidos'] != null){ ?>
							<input type="text" id="apellidosN" class="form-control" name="apellidosN" value="<?php echo $datos['Apellidos']; ?>" title="<?php echo $strings['error trabajador']; ?>" required>
							<?php }else{ ?>
							<input type="text" id="apellidosN" class="form-control" name="apellidosN"  title="<?php echo $strings['error trabajador']; ?>" required>
							<?php } ?>
						</div>
					</div>

					<!-- Campo Foto de perfil -->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['fotoperfil'];?>:</label>
						</div>
						<div class="col-sm-4">
							<img src="<?php echo $datos['Url_Foto']; ?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre"  class="control-label"><?php echo $strings['fotoperfil'];?>:</label>
						</div>
						<div class="col-sm-4">
							<input name="fotoperfilN" type="file" class="control-label" title="<?php echo $strings['error trabajador']; ?>" >
						</div>
					</div>

					<!-- Campo Direccion -->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<?php if($datos['Direccion'] != null){ ?>
							<input type="text" id="direccionN" class="form-control" name="direccionN" value="<?php echo $datos['Direccion'];?>" title="<?php echo $strings['error trabajador']; ?>" required>
							<?php }else{ ?>
							<input type="text" id="direccionN" class="form-control" name="direccionN"  title="<?php echo $strings['error trabajador']; ?>" required>
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
							<input type="text" id="emailN" class="form-control" name="emailN" value="<?php echo $datos['Email'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php echo $strings['error trabajador']; ?>" required>
							<?php }else{ ?>
							<input type="text" id="emailN" class="form-control" name="emailN" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php echo $strings['error trabajador']; ?>" required>
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
							<input class = "tcal" type="date" id="fechanacN" class="form-control" name="fechanacN" value="<?php echo $datos['Fecha_Nacimiento'];?>"  title="<?php echo $strings['error trabajador']; ?>" required>
							<?php }else{ ?>
							<input class = "tcal" type="date" id="fechanacN" class="form-control" name="fechanacN"  title="<?php echo $strings['error trabajador']; ?>" required>
							<?php } ?>
						</div>
					</div>
					

					<!-- Campo Tipo de Empleado-->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<select id="tipoempN" name="tipoempN" >
								<?php if($datos['Tipo_Empleado']=='administrador'){ ?>
								<option value="administrador" selected><?php echo $strings['administrador'];?></option>;
								<?php }else{ ?>
								<option value="administrador" ><?php echo $strings['administrador'];?></option>;
								<?php } ?>

								<?php if($datos['Tipo_Empleado']=='secretario'){ ?>
								<option value="secretario" selected><?php echo $strings['secretario'];?></option>;
								<?php }else{ ?>
								<option value="secretario"><?php echo $strings['secretario'];?></option>;
								<?php } ?>

								<?php if($datos['Tipo_Empleado']=='monitor'){ ?>
								<option value="monitor" selected><?php echo $strings['monitor'];?></option>;
								<?php }else{ ?>
								<option value="monitor"><?php echo $strings['monitor'];?></option>;
								<?php } ?>

								<?php if($datos['Tipo_Emp']=='fisioterapeuta'){ ?>
								<option value="fisioterapeuta" selected><?php echo $strings['fisioterapeuta'];?></option>;
								<?php }else{ ?>
								<option value="fisioterapeuta"><?php echo $strings['fisioterapeuta'];?></option>;
								<?php } ?>

								<?php if($datos['Tipo_Empleado']=='cafeteria'){ ?>
								<option value="cafeteria" selected><?php echo $strings['cafeteria'];?></option>;
								<?php }else{ ?>
								<option value="cafeteria"><?php echo $strings['cafeteria'];?></option>;
								<?php } ?>

								<?php if($datos['Tipo_Empleado']=='limpieza'){ ?>
								<option value="limpieza" selected><?php echo $strings['limpieza'];?></option>;
								<?php }else{ ?>
								<option value="limpieza"><?php echo $strings['limpieza'];?></option>;
								<?php } ?>
								
								<?php if($datos['Tipo_Empleado']=='otros'){ ?>
								<option value="otros" selected><?php echo $strings['otros'];?></option>;
								<?php }else{ ?>
								<option value="otros"><?php echo $strings['otros'];?></option>;
								<?php } ?>
							</select>
						</select>
					</div>
				</div>
				
				
				
				<!-- Campo Observaciones -->
				<div class="form-group">
					<div class="col-sm-4">
						<label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
					</div>
					<div class="col-sm-4">
						<?php if($datos['Observaciones'] != null){ ?>
						<textarea id="observacionesN" name="observacionesN" rows="10" cols="40"><?php echo $datos['Observaciones']; ?></textarea>
						<?php }else{ ?>
						<textarea id="observacionesN" name="observacionesN" rows="10" cols="40"></textarea>
						<?php } ?>
					</div>
				</div>


				<!-- Campo Telefono -->
								
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['telefono']; ?>:</label>
									</div>
									<div class="col-sm-4">
									<?php if($datos['Telefono'] != null){ ?>
									<input type="text" class="form-control" name="telefonoN" value="<?php echo $datos['Telefono']; ?>"  title="<?php echo $strings['error telefono']; ?>">
									<?php }else{ ?>
										<input type="text" class="form-control" name="telefonoN"  title="<?php echo $strings['error telefono']; ?>">
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
						<input type="text" id="numerocuentaN" class="form-control" name="numerocuentaN"  value="<?php echo $datos['Numero_Cuenta']; ?>" title="<?php echo $strings['error trabajador']; ?>" required>
						<?php }else{ ?>
						<input type="text" id="numerocuentaN" class="form-control" name="numerocuentaN"  title="<?php echo $strings['error trabajador']; ?>" required>
						<?php } ?>
					</div>
				</div>


				
				<!-- Campo Externo-->
				<div class="form-group">
					<div class="col-sm-4">
						<label for="nombre" class="control-label"><?php echo $strings['externo']; ?>:</label>
					</div>
					<div class="col-sm-4">
						<?php if($datos['Externo'] == 0){?>
						<input type="radio" id="externoN" name="externoN" value="0" checked><?php echo $strings['externo'];?>
						<br>
						<input type="radio" id="externoN" name="externoN" value="1"><?php echo $strings['interno'];?>
						<?php }else{?>
						<input type="radio" id="externoN" name="externoN" value="0"><?php echo $strings['externo'];?>
						<br>
						<input type="radio" id="externoN" name="externoN" value="1" checked><?php echo $strings['interno'];?>
						<?php 	} ?>
					</div>
				</div>
				

				<!-- Submit para editar el trabajador, con confirmación -->
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