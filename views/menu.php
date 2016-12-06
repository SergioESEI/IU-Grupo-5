<html>
	<head>
		<link href="../bootstrap/menu.css" rel="stylesheet">
	</head>

	<div class="col-sm-2">

	<!-- Muestra distintas opciones en el menú lateral en función del grupo de usuarios al que pertenece el usuario -->
	<nav class="navbar navbar-inverse sidebar" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"><?php echo $strings['menu'] ?></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
				<ul class="nav navbar-nav">

				<!-- Menú del Admin: -->
				<?php if(strcmp($_SESSION['grupo'],'Admin')== 0){ ?>

					<!-- Gestión de usuarios -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarUsuario']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=altaUsuario">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=bajaUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=modificarUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=consultarUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=buscarUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarUsuario']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de grupos/perfiles -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarGrupos']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=altaGrupo">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaGrupo']; ?></a>
							</li>
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=bajaGrupo">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaGrupo']; ?></a>
							</li>
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=modificarGrupo">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarGrupo']; ?></a>
							</li>
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=consultarGrupo">
							 <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarGrupo']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de funcionalidades/controladores -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarControladores']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list-alt"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=altaControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=altaAccion">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaAccion']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=bajaControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span></span><?php echo $strings['bajaControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=modificarControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=consultarControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=buscarControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarFuncionalidad']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de clientes -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarCliente']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=altaCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaCliente']; ?></a>
								</li>
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=bajaCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaCliente']; ?></a>
								</li>
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=modificarCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarCliente']; ?></a>
								</li>
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=consultarCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarClientes']; ?></a>
								</li>
								<li>
								  <a href="../controllers/CLIENTEEXTERNO_Controller.php?id=buscarCliente">
								  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarCliente']; ?></a>
								</li>
							</ul>
					</li>

					<!-- Gestión de servicios -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarServicio']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=altaServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaServicio']; ?></a>
								</li>
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=bajaServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaServicio']; ?></a>
								</li>
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=modificarServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarServicio']; ?></a>
								</li>
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=consultarServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarServicio']; ?></a>
								</li>
								<li>
								  <a href="../controllers/SERVICIO_Controller.php?id=buscarServicio">
								  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarServicio']; ?></a>
								</li>
							</ul>
					</li>



					<!-- Gestión de permisos -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarPermisos']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-lock"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=altaPermiso">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=bajaPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=modificarPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=consultarPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=buscarPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarPermiso']; ?></a>
							</li>
						</ul>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	</div>
</html>
