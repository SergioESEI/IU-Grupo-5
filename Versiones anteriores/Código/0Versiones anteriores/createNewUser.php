
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
  </head>
    <title>alta de usuario</title>
    <body>

        <div class="section">
          <div class="container">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                                <div class="col-md-12"> <h2 class="text-info ">NUEVO USUARIO</h2></div>
                                <div class="col-md-12"><hr></div>

                                <!-- Campo nombre-->
                                <div class="form-group">
                                    <div class="col-sm-4">
                                      <label for="nombre" class="control-label">Nombre Usuario</label>
                                    </div>
                                    <div class="col-sm-4">
                                      <input type="text" class="form-control" id="nombre" placeholder="Nombre Usuario">
                                    </div>
                                </div>
                                <!-- Campo apellido -->
                                <div class="form-group">
                                      <div class="col-sm-4">
                                          <label for="apellidos" class="control-label">Apellido</label>
                                      </div>
                                      <div class="col-sm-4">
                                          <input type="text" class="form-control" id="apellidos" placeholder="Apellido del usuario"/>
                                      </div>
                                </div>
                                <!-- Campo DNI -->
                                <div class="form-group">
                                      <div class="col-sm-4">
                                          <label for="dni" class="control-label">DNI:</label>
                                      </div>
                                      <div class="col-sm-4">
                                          <input type="text" class="form-control" id="dni" placeholder="DNI del usuario">
                                      </div>
                                  </div>
                                <!-- Campo Password -->
                                <div class="form-group">
                                      <div class="col-sm-4">
                                          <label for="password" class="control-label" required>Contraseña del usuario</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="password" class="form-control" id="password">
                                      </div>
                                  </div>
                                <!-- Campo URL foto -->
                                <div class="form-group">
                                    <div class="col-sm-4">
                                      <label for="url" class="control-label" required>Foto del usuario</label>
                                    </div>
                                    <div class="col-sm-3">
                                      <input type="file" accept="image/*" class="form-control" id="urlFoto">
                                    </div>
                                </div>
                                <!-- Campo Telefono -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="telefono" class="control-label" required>Telefono del usuario</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="tel"class="form-control" id="telefono">
                                  </div>
                                </div>
                                <!-- Campo email -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="email" class="control-label" required>E-mail del usuario</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="email"  class="form-control" id="email">
                                  </div>
                                </div>
                                <!-- Campo Direccion -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="direccion" class="control-label" required>Direccion del usuario</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text"  class="form-control" id="direccion">
                                  </div>
                                </div>
                                <!-- Campo Fecha nacimiento -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="fechaNac" class="control-label" required>Fecha nacimiento del usuario</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="date"  class="form-control" id="fechaNac" name="fechaNac">
                                  </div>
                                </div>
                                <!-- Campo Observaciones -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="observaciones" class="control-label">Observación del usuario</label>
                                  </div>
                                  <div class="col-sm-8" id="descripcion" name="observaciones">
                                    <textarea rows="6" cols="62"></textarea>
                                  </div>
                                </div>
                                <!-- Campo Número de cuenta -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="numCuenta" class="control-label" required>Número de cuenta del usuario</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text"  class="form-control" id="numCuenta" name="numCuenta">
                                  </div>
                                </div>
                                <!-- Campo Externo -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="externo" class="control-label" required>¿Es externo? /S= si, /N=no</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="text"  class="form-control" id="externo" name="externo">
                                  </div>
                                </div>
                                <!-- Campo Horas extras -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="horasExtras" class="control-label" required>Horas extras</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type="number"  class="form-control" id="horasExtras" name="horasExtras" placeholder="Ejm: 12, 01, 100">
                                  </div>
                                </div>
                                <!-- Campo Horas extras -->
                                <div class="form-group">
                                  <div class="col-sm-4">
                                    <label for="profesion" class="control-label" required>Profesión</label>
                                  </div>
                                  <div class="col-sm-3">
                                    <input type=""  class="form-control" id="profesion" name="profesion">
                                  </div>
                                </div>
                                <!-- Campo Grupo -->
                                <div class="form-group">
                                            <div class="col-sm-4">
                                                <label for="grupo" class="control-label">Grupo del usuario</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <select class="btn btn-primary" id="grupo" name="grupo" selected="Selecciona el grupo">
                                                    <option></option>
                                                    <option value="0">Administrador</option>
                                                    <option value="1">Monitor</option>
                                                    <option value="2">Fisio</option>
                                                    <option value="3">Secretario</option>
                                                </select>
                                            </div>
                                </div>

                                  <div class="form-group">
                                      <div class="col-sm-2"><input class="btn btn-primary" type="submit"></div>
                                      <div class="col-sm-2"><input class="btn btn-default" type="reset"></div>
                                  </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
