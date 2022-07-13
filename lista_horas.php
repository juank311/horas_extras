<?php include "includes/header.php" ?>

<?php
//variables no existentes 

$current_date = date('d-M-Y');
echo $current_date;
$type = "Horas Extras";
//Insertamos datos
if (isset($_POST["registrarHoras"])) {

  //Obtener valores
  
  $id_employee = $_POST["id_employee"];
  $date = $_POST["date"];
  $festive = $_POST["festive"];
  $start_hour = $_POST["start_hour"];
  $final_hour = $_POST["final_hour"];
  $creation_date = $current_date;
  
//Si entra por aquí es porque la cédula no existe y se puede crear el registro
    $query_insert = "INSERT INTO records(type, date, festive, start_hour, final_hour, id_employee, creation_date)
    VALUES(:type, :date, :festive, :start_hour, :final_hour, :id_employee, :creation_date)";

    $stmt_insert = $conn->prepare($query_insert);

    $stmt_insert->bindParam(":type", $type, PDO::PARAM_STR);
    $stmt_insert->bindParam(":date", $date, PDO::PARAM_STR);
    $stmt_insert->bindParam(":festive", $festive, PDO::PARAM_STR);
    $stmt_insert->bindParam(":start_hour", $start_hour, PDO::PARAM_STR);
    $stmt_insert->bindParam(":final_hour", $final_hour, PDO::PARAM_STR);
    $stmt_insert->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
    $stmt_insert->bindParam(":creation_date", $current_date, PDO::PARAM_STR);

    $resultado = $stmt_insert->execute();

    if ($resultado) {
      $mensaje = "Registro creado correctamente";
    } else {
      $error = "Error, no se pudo crear el registro";
    }
  }

?>

<?php
$query_search = "SELECT * FROM records";
$stmt_search = $conn->query($query_search);
$recordsTable = $stmt_search->fetchAll(PDO::FETCH_OBJ);
//var_dump($recordsTable);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lista de Horas Extras</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-9">
                  <h3 class="card-title"><b>Horas Extras</b></h3>
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn btn-primary btn-xl pull-right w-100" data-toggle="modal" data-target="#modal-ingresar-horas">
                    <i class="fa fa-plus"></i> Ingresar nuevo registro
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tblRegistros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Festivo</th>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Empleado</th>
                    <th>Fecha creación</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <?php foreach ($recordsTable as $row) : ?>
                  <tr>

                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->type; ?></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->festive; ?></td>
                    <td><?php echo $row->start_hour; ?></td>
                    <td><?php echo $row->final_hour; ?></td>
                    <td><?php echo $row->id_employee; ?></td>
                    <td><?php echo $row->creation_date; ?></td>
                    <td>
                      <a href="#" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                        </svg> Editar</a>
                      <a href="#" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg></i> Borrar</a>

                    </td>

                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
            <!-- /.card-body -->

            <!--MODALS INSERTAR HORAS-->
            <div class="modal fade" id="modal-ingresar-horas">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title"><strong>Nuevo registro de horas extras</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">

                    <div id="errores" style="color: red;"></div>

                    <!-- form start -->
                    <div class="box-body">

                      <div class="row">
                        <div class="col-xs-6">
                          <div class="form-group">
                            <label for="idCard_search">Buscar empleado:</label>
                            <input type="text" class="form-control" id="idCard_search" placeholder="Ingresa un # de cédula">

                            <!-- En este div se muestran los mensaje de error si los hubiera-->
                            <div id="mensaje" style="color: red;"></div>
                          </div>
                        </div>

                        <div class="col-xs-6" style="margin-top:32px;">
                          <div class="form-group">
                            <!-- Our search button -->
                            <!-- Our search button -->
                            <!--<input type="button" id="buscar_id_card" value="Search">	-->
                            &nbsp;
                            <button id="btn_search_idcard" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                          </div>
                        </div>
                      </div>

                      <!-- FORMULARIO DE CAMPOS DEL MODAL -->
                      <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="row">
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label for="id_employee">ID empleado: </label>
                              <input type="text" class="form-control" name="id_employee" id="id_employee" readonly>
                            </div>
                          </div>
                          <!-- Nombre -->
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label for="name_employee">
                                <span>Nombre de empleado:</span>
                              </label>
                              <input type="text" class="form-control" id="name_employee" name="name" readonly>
                              <!-- Apellidos -->
                              <label for="lastname_employee">Apellidos: </label>
                              <input type="text" class="form-control" id="lastname_employee" name="last_name" readonly>
                            </div>
                          </div>
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                          <label>Fecha:</label>
                          <div class="input-group date" id="fecha" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="date">
                            <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                        <!-- /.form group -->


                        <div class="clearfix"></div>

                        <div class="row">
                          <div class="col-sm-10 offset-1">
                            <!-- FESTIVOO -->
                            <div class="form-group">
                              <label for="festivo">Festivo:</label>
                              <select class="form-control" name="festive" id="festivo">
                                <option value="">--Seleccionar un valor--</option>
                                <option value="Domingo">Domingo</option>
                                <option value="Festivo">Festivo</option>
                                <option value="0">Normal</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-sm-6">

                            <div class="bootstrap-timepicker">
                              <div class="form-group">
                                <label>Hora Inicial:</label>

                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" name="start_hour">
                                  <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                  </div>
                                </div>
                                <!-- /.input group -->
                              </div>
                              <!-- /.form group -->
                            </div>

                          </div>

                          <div class="col-sm-6">

                            <div class="form-group">
                              <label>Hora Final:</label>

                              <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input horasReg" data-target="#timepicker2" name="final_hour">
                                <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                              </div>
                              <!-- /.input group -->
                            </div>

                          </div>

                        </div>

                    </div>

                    <!-- BOTONESSSS -->
                    <div class="box-footer">
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>

                        <button type="submit" name="registrarHoras" id="registrarHoras" class="btn btn-primary"><i class="fas fa-cog"></i> Registrar</button>
                      </div>
                      </form>
                      <!-- /.input group -->

                    </div>

                  </div>

                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </div>
        </div>


        <?php include "includes/footer.php" ?>

        <!-- page script -->
        <script>
          $(function() {
            $('#tblRegistros').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });

            //Date range picker
            $('#fecha').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'
            });

            //Hora Inicial
            $('#timepicker').datetimepicker({
              format: 'HH:mm',
              enabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
              stepping: 30

            })

            //Hora Final
            $('#timepicker2').datetimepicker({
              format: 'HH:mm',
              enabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
              stepping: 30
            })


            //si el boton ha sido clickeado se identifica con #btn_search_idcard 
            $('#btn_search_idcard').click(function() {

              //Si el botón ha si do clickeado
              //Obtengo el código del empleado
              let id_card = $('#idCard_search').val();

              if (id_card == "" || id_card == null) {
                $('#mensaje').html("Error, campo vacío, ingresa un # de cédula");
                /* return false; */
              } else {
                //Enviar con ajax
                $.ajax({
                  //La url del archivo php
                  type: "GET",
                  url: "http://localhost/horas_extras/search_idcard.php",
                  data: {
                    card_id: id_card //<- card_id es la variable modificable 
                  },
                  success: function(returnData) {
                    console.log(JSON.parse(returnData));
                    $('#name_employee').val("");
                    $('#lastname_employee').val("");
                    $('#id_employee').val("");
                    

                    //Parsear el json
                    let results = JSON.parse(returnData);

                    $.each(results, function(key, value) {

                      if (value == "" || value == null) {
                        $('#name_employee').val("");
                        $('#id_employee').val("");
                        $('#mensaje').html("No existe empleado con esa cédula!");
                      } else {
                        $('#name_employee').val(value.name);
                        $('#lastname_employee').val(value.last_name);
                        $('#id_employee').val(value.id);
                        $('#mensaje').html("");
                      }

                    });
                  },
                  error: function(error) {
                    $('#mensaje').html("No existe empleado con esa cédula!");
                  }
                });
              }
            });
          });
        </script>