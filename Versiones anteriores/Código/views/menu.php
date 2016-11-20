<html> 
	<div class="col-sm-2 sidenav">
		
	<!-- Muestra distintas opciones en el menú lateral en función del grupo de usuarios al que pertenece el usuario -->
	<h1><small><?php echo $strings['menu']; ?></small></h1>
	
	<?php if(strcmp($_SESSION['grupo'],"Admin") == 0 ){ ?>
	<div class="btn-group">
		<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $strings['gestionarControladores']; ?></button>
		<div class="dropdown-menu">
			<li>
			  <a href="../controllers/CONTROLADOR_Controller.php?id=altaControlador">
			  <?php echo $strings['altaControlador']; ?></a>
			</li>
			<li>
			  <a href="../controllers/CONTROLADOR_Controller.php?id=bajaControlador">
			  <?php echo $strings['bajaControlador']; ?></a>
			</li>
			<li>
			  <a href="../controllers/CONTROLADOR_Controller.php?id=modificarControlador">
			  <?php echo $strings['modificarControlador']; ?></a>
			</li>
			<li>
			  <a href="../controllers/CONTROLADOR_Controller.php?id=consultarControlador">
			  <?php echo $strings['consultarControlador']; ?></a>
			</li>
		</div>
	</div>
	<div class="btn-group">
		<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $strings['gestionarPermisos']; ?></button>
		<div class="dropdown-menu">
			<li>
			  <a href="../controllers/PERMISO_Controller.php?id=altaPermiso">
			   <?php echo $strings['altaPermiso']; ?></a>
			</li>
			<li>
			  <a href="../controllers/PERMISO_Controller.php?id=bajaPermiso">
			  <?php echo $strings['bajaPermiso']; ?></a>
			</li>
			<li>
			  <a href="../controllers/PERMISO_Controller.php?id=modificarPermiso">
			  <?php echo $strings['modificarPermiso']; ?></a>
			</li>
			<li>
			  <a href="../controllers/PERMISO_Controller.php?id=consultarPermiso">
			  <?php echo $strings['consultarPermiso']; ?></a>
			</li>
          </div>
	</div>
	<div class="btn-group">
		<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $strings['gestionarGrupos']; ?></button>
		<div class="dropdown-menu">
			<li>
			  <a href="../controllers/GRUPO_Controller.php?id=altaGrupo">
			   <?php echo $strings['altaGrupo']; ?></a>
			</li>
			<li>
			  <a href="../controllers/GRUPO_Controller.php?id=bajaGrupo">
			  <?php echo $strings['bajaGrupo']; ?></a>
			</li>
			<li>
			  <a href="../controllers/GRUPO_Controller.php?id=modificarGrupo">
			  <?php echo $strings['modificarGrupo']; ?></a>
			</li>
			<li>
			  <a href="../controllers/GRUPO_Controller.php?id=consultarGrupo">
			 <?php echo $strings['consultarGrupo']; ?></a>
			</li>
         </div>
	</div>	
	<div class="btn-group">
		<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $strings['gestionarUsuario']; ?></button>
		<div class="dropdown-menu">
			<li>
			  <a href="../controllers/USUARIO_Controller.php?id=altaUsuario">
			   <?php echo $strings['altaUsuario']; ?></a>
			</li>
			<li>
			  <a href="../controllers/USUARIO_Controller.php?id=bajaUsuario">
			  <?php echo $strings['bajaUsuario']; ?></a>
			</li>
			<li>
			  <a href="../controllers/USUARIO_Controller.php?id=modificarUsuario">
			  <?php echo $strings['modificarUsuario']; ?></a>
			</li>
			<li>
			  <a href="../controllers/USUARIO_Controller.php?id=consultarUsuario">
			  <?php echo $strings['consultarUsuario']; ?></a>
			</li>
          </div>
	</div>			
	<?php } ?>	
	</div>
</html>