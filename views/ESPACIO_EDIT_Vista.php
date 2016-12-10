<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],'Secretario')==0 ){

//Crea la clase e instancia la función render en el constructor.
    class Espacio_Editar{

        function __construct(){
            $this->render();
        }

        function render(){
            include_once('../header.php');
            ?>
            <!-- Título de la página -->
            <title><?php echo $strings['titulo editar espacio']; ?></title>

            <script>
                //Confirman la edición.
                function pregunta(){
                    var espacio = document.getElementById("espacio").value;
                    var idEspacio= document.getElementById("idEspacioN").value;
                    if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
                            '\n\n<?php echo $strings['espacio']; ?>: '+espacio)){
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

                            <!-- Formulario para editar el espacio -->
                            <form class="form-horizontal" role="form" method="POST" name="formulario" action="../controllers/ESPACIO_Controller.php?id=modificarEspacio" onsubmit="return pregunta()">
                                <div class="form-group">
                                    <div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar espacio']; ?></h2></div>
                                    <div class="col-md-12"><hr></div>

                                    <!-- Campo para seleccionar el espacio a modificar -->
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="nombre" class="control-label"><?php echo $strings['espacio']; ?>:</label>
                                        </div><div class="col-sm-4">
                                            <select name="espacio" required>
                                                <?php listarEspacios(); ?>
                                            </select>
                                        </div></div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo para escribir el espacio modificado -->
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="espacioN" class="control-label"><?php echo $strings['espacio']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="espacioN" name="espacioN" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="idEspacioN" class="control-label"><?php echo $strings['idEspacio']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="idEspacioN" name="idEspacioN" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>

                                <!-- Submit para editar grupo, con confirmación -->
                                <div class="form-group">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">
                                    </div></div>
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