<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Crear{

		function __construct(){
			$this->render();
		}
		function render(){
			require_once('../header.php'); 
			?>
			<!-- Título de la página -->
			<title><?php echo $strings['titulo añadir trabajador']; ?></title>
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


		function validateForm() {
		    var nombre = document.forms["form"]["nombre"].value;
		    if (x == "") {
		        alert("Name must be filled out");
        return false;
    }
}
	</script>
	<body>
		<!-- Include del menú-->
		<div class="row-fluid">
			<?php include_once('menu.php'); ?>

			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">

						
						<!-- Formulario para añadir usuario -->
						<form class="form-horizontal" role="form" action="../controllers/TRABAJADOR_Controller.php?id=altaTrabajador" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
							<div class="form-group"  >
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['añadir trabajador']; ?></h2></div>
								<div class="col-md-12"><hr></div>

								<!-- Campo DNI-->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
									</div>
									<div class="col-sm-4"> 
										<input type="text" required class="form-control" name="dni" onblur="nif(this.value)">
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
										<input type="text" class="form-control" name="apellidos"  title="<?php echo $strings['error trabajador']; ?>" required>
									</div>
								</div>

								<!-- Campo Foto de perfil -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['fotoperfil'];?>:</label>
									</div>
									<div class="col-sm-4">
										<input name="fotoperfil" type="file" class="control-label" title="<?php echo $strings['error trabajador']; ?>" required>
									</div>
								</div>

								<!-- Campo Direccion -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="direccion"  title="<?php echo $strings['error trabajador']; ?>" required>
									</div>
								</div>

								<!-- Campo Email -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php echo $strings['error trabajador']; ?>" required>
									</div>
								</div>

								<!-- Campo Fecha Nacimiento -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['fechanac']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input class = "tcal" type = "date" name="fechanac"  title="<?php echo $strings['error trabajador']; ?>" required>
									</div>
								</div>


								<!-- Campo Tipo de Empleado-->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['tipoemp']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<select name="tipoemp" required>
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
										<input type="text" class="form-control" name="numerocuenta"  title="<?php echo $strings['error trabajador']; ?>" required>
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
										<input type="radio" name="externo" value="0" autofocus required="required"><?php echo $strings['externo'];?>
										<br>
										<input type="radio" name="externo" value="1"><?php echo $strings['interno'];?>
									</div>
								</div>
								

								<!-- Submit que envía los datos para crear el trabajador -->
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
