<?php include "includes/header.php" ?>
<?php

//consulta para insercion de datos 
if (isset($_POST['registrarEmpleado'])) {
  //Recoge los valores
  $name = trim($_POST['name']);
  $last_name = trim($_POST['last_name']);
  $id_card = trim($_POST['id_card']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $is_admin = trim($_POST['is_admin']);

  if (isset($_POST['registrarEmpleado'])) {
    $query_validation = "SELECT * FROM employees WHERE id_Card = ?";
    $stmt_validation = $conn->prepare($query_validation);
    $stmt_validation->execute([$id_card]);
    $validation = $stmt_validation->fetch(PDO::FETCH_ASSOC);
    //var_dump($validation);

    if ($validation) {
      $error = "El numero de cedula ya se encuentra registrado";
      echo $error;
    } else {

    if (
      !isset($name) || trim($name == null) || trim($name == "") ||
      !isset($last_name) || trim($last_name == null) || trim($last_name == "") ||
      !isset($id_card) || trim($id_card == null) || trim($id_card == "") ||
      !isset($phone) || trim($phone == null) || trim($phone == "") ||
      !isset($email) || trim($email == null) || trim($email == "") ||
      !isset($is_admin) || trim($is_admin == null) || trim($is_admin == "")
      ) {

      $error = "Existe un campo vacio";
      echo $error;
      } else {
      $query_insert = "INSERT INTO employees (name, last_name, id_card, email, phone, is_admin) 
            VALUES (:name, :last_name, :id_card, :email, :phone, :is_admin)";
      $stmt_insert = $conn->prepare($query_insert);

      $stmt_insert->BindParam(':name', $name, PDO::PARAM_STR);
      $stmt_insert->BindParam(':last_name', $last_name, PDO::PARAM_STR);
      $stmt_insert->BindParam(':id_card', $id_card, PDO::PARAM_STR);
      $stmt_insert->BindParam(':email', $email, PDO::PARAM_STR);
      $stmt_insert->BindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt_insert->BindParam(':is_admin', $is_admin, PDO::PARAM_INT);
      $activation = $stmt_insert->execute();

      if ($activation) {
        $mensaje = "Empleado agregado exitosamente!";
      } else {
        $error = "no se pudo contectar con la base de datos";
        echo $error;
      }
    }
  }
  }
}
//Conculta para mostrar en tabla 
$query_search = "SELECT * FROM employees";
$stmt_search = $conn->query($query_search);
$employeesTable = $stmt_search->fetchAll(PDO::FETCH_OBJ);
//var_dump($employeesTable);
?>
<!-- HTML -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Empleados</b></h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-primary btn-xl pull-right w-10" data-toggle="modal" data-target="#modal-ingresar-nuevo-usuario">
            <i class="fa fa-plus"></i> Nuevo Usuario
          </button>
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-9">
                  <h3 class="card-title"><b>Lista de Empleados</b></h3>
                </div>
                <div class="col-md-2">

                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tblUsuarios" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Es Administrador</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($employeesTable as $row) : ?>
                    <tr>

                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->last_name; ?></td>
                      <td><?php echo $row->id_card; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->phone; ?></td>
                      <td><?php echo $row->is_admin; ?></td>
                      <td>
                        <a href="#" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                          </svg> Editar</a>
                        <a href="#" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                          </svg></i> Borrar</a>

                      </td>

                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <!--MODALS INSERTAR NUEVO USUARIO-->
            <div class="modal fade" id="modal-ingresar-nuevo-usuario">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title"><strong>Nuevo registro de Empleado</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">

                    <div id="errores" style="color: red;"></div>

                    <!-- form start -->
                    <div class="box-body">
                      <!-- /.card-header -->
                      <div class="card-body">
                        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                          <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" name="name" placeholder="Ingresa el nombre">
                          </div>
                          <div class="form-group">
                            <label for="last_name">Apellidos:</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Ingrese los apellidos">
                          </div>
                          <div class="form-group">
                            <label for="id_card"># de Cédula:</label>
                            <input type="number" class="form-control" name="id_card" placeholder="Ingresa el # de cédula">
                          </div>
                          <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="name@example.com">
                          </div>
                          <div class="form-group">
                            <label for="phone">Telefono:</label>
                            <input type="text" class="form-control" name="phone" placeholder="Ingrese el Numero de Telefono">
                          </div>
                          <div class="form-group">
                            <label for="is_admin">Es Administrador</label>
                            <select class="form-control" name="is_admin">
                              <option value="">--Selecciona un valor--</option>
                              <option value="1">Si</option>
                              <option value="0">No</option>
                            </select>
                          </div>
                          <!--  <button type="submit" name="crearEmpleado" class="btn btn-primary w-100"><i class="fas fa-user"></i> Crear Nuevo Empleado</button> -->
                          <div class="box-footer">
                            <div class="modal-footer">
                              <button type="button" class="btn btn-success pull-left" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>

                              <button type="submit" name="registrarEmpleado" id="registrarEmpleado" class="btn btn-primary"><i class="fas fa-user"></i> Crear Nuevo Empleado</button>
                            </div>
                        </form>
                      </div>
                      <!-- /.card-body -->
                    </div>
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
          $('#tblUsuarios').DataTable({
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
            format: 'L'
          });

          //Timepicker
          $('#timepicker').datetimepicker({
            format: 'HH:mm',
            enabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
            stepping: 30
          })



        });
      </script>