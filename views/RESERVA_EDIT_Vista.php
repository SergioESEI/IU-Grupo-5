<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],'Secretario')==0){

//Crea la clase e instancia la función render en el constructor.
    class Reserva_Editar{

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
                    var espacio = document.getElementById("reserva").value;
                    var idEspacio= document.getElementById("idEspacioN").value;
                    if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
                            '\n\n<?php echo $strings['reserva']; ?>: '+espacio)){
                        document.formulario.submit();
                    } else return false;
                }

            </script>
            <script>
                function fecha() {
                    var fechaIni =document.getElementById("Hora_InicioN").value;
                    var fechaFin = document.getElementById("Hora_FinN").value;
                    if(fechaFin <= fechaIni){
                     return true;
                    }
                    return false;
                }
            </script>

            <body>
            <div class="row-fluid">
                <!-- Include del menú -->
                <?php include_once('menu.php'); ?>
                <div class="col-sm-10 text-left">
                    <div class="section-fluid">
                        <div class="container-fluid">

                            <!-- Formulario para editar la reserva -->
                            <form class="form-horizontal" role="form" method="POST" name="formulario" action="../controllers/ESPACIO_Controller.php?id=modificarReserva" onsubmit="return pregunta()">
                                <div class="form-group">
                                    <div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar reserva']; ?></h2></div>
                                    <div class="col-md-12"><hr></div>



                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="reservaN" class="control-label"><?php echo $strings['reserva']; ?>:</label>
                                        </div><div class="col-sm-4">
                                            <select name="reservaN" required>
                                                <?php listarReservas()?>
                                            </select>
                                        </div></div>
                                </div>

                                <!-- Campos para realizar la reserva -->


                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="TelefonoN" class="control-label"><?php echo $strings['Telefono']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="tel" pattern="[0-9]{9}"  class="form-control" id="TelefonoN" name="TelefonoN" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="Hora_InicioN" class="control-label"><?php echo $strings['Hora_Inicio']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="time"  class="form-control" id="Hora_InicioN" name="Hora_InicioN" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="Hora_FinN" class="control-label"><?php echo $strings['Hora_Fin']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="time" step="60" min="7:00" max="23:00" class="form-control" onblur="if(fecha()==true){this.value=''}" id="Hora_FinN" name="Hora_FinN" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="FechaN" class="control-label"><?php echo $strings['Fecha']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="date" min="<?php echo date("Y-m-d");?>" step="1" value="<?php echo date("Y-m-d");?>" class="form-control"  id="FechaN" name="FechaN" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="DescripcionN" class="control-label"><?php echo $strings['Descripcion']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="DescripcionN" name="DescripcionN" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="DNI_ReservaN" class="control-label"><?php echo $strings['DNI_Reserva']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"  pid="DNI_ReservaN" name="DNI_ReservaN" title="<?php echo $strings['error espacio']; ?>" required pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="espacioN" class="control-label"><?php echo $strings['espacio']; ?>:</label>
                                    </div><div class="col-sm-4">
                                        <select name="espacioN" required>
                                            <?php listarEspacios()?>
                                        </select>
                                    </div></div>
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