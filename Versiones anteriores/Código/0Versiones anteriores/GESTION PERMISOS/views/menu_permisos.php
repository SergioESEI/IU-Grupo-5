<html> 
	<div class="col-sm-2 sidenav">
	<?php 
	//Muestra distintas opciones en el menú lateral en función del grupo de usuarios al que pertenece.
	if(strcmp($_SESSION['grupo'],"Admin") == 0 ){ ?>
	<h1><?php echo $strings['menu']; ?></h1>
	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $strings['gestionarPermisos']; ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li>
			  <a href="../controllers/PERMISO_controller.php?id=consultarPermisos">
			  <?php echo $strings['consultarPermisos']; ?></a>
			</li>
			<li>
			  <a href="../controllers/PERMISO_controller.php?id=modificarPermisos">
			  <?php echo $strings['modificarPermisos']; ?></a>
			</li>
          </ul>
        </li>	
	<?php } ?>	
	</div>
</html>