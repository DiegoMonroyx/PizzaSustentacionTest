<?php
  include("../../conectar/conexion.php");
  include("../../controlador/tipoUsuarioController.php");

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo Usuario</title>
    <link rel="stylesheet" href="../../Config/css/bootstrap.min.css">
    <link rel="stylesheet" href="../estilos.css">
    <script src="https://kit.fontawesome.com/7e532953a9.js" crossorigin="anonymous"></script>
    <script src="function.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
      <table class="table table-bordered border-1 border--bs-secondary-color table-hover bg-light" id="tabla" style="width: 60%; border-radius: 10px; overflow: hidden;">
          <thead class="border-1 border-dark" id="succes" style="background-color: #239227;">
              <tr style="color: white">
                <th scope="col">id</th>
                <th scope="col" style="text-align: center;">Tipo de Usuario</th>
              </tr>
          </thead>
          <tbody class="table-group-divider">
              <?php
              $GAU = 1;
              if ($res == 0) {
                  echo "<tr><td colspan='2' style='text-align: center;'>No hay registros</td></tr>";
              } else {
                  do {
                      ?>
                      <tr>
                          <td><?php echo $res[0]; ?></td>
                          <td style="display: flex; justify-content: space-between; align-items: center;">
                              <span><?php echo $res[1]; ?></span>
                              <form class="d-flex justify-content-center align-items-center" action="" method="post">
                                  <button type="button" class="btn btn-sm btn-primary boton editM" style="color: black;"><i class="fa-solid fa-pen-to-square"></i></button>
                              </form>
                          </td>
                      </tr>
                      <div class="modal fade" id="editar" name="" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="" style="color: Black;">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <form action="" class="" method="post">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel">Modificar</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body row g-3">
                                          <div class="col-md-6">
                                              <label for="inputAddress2" class="form-label">id Tipo Usuarios</label>
                                              <input type="number" name="idTipoUsuario" id="idTipoUsuario" class="form-control" placeholder="" readonly>
                                          </div>
                                          <div class="col-md-6">
                                              <label for="inputPassword4" class="form-label">Tipo de Usuario</label>
                                              <input type="text" name="tipoUsuario" id="tipoUsuario" class="form-control">
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                          <button type="submit" href="UsuarioAdmin.php" name="modifica" class="btn btn-success">Modificar</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <?php
                  } while ($res = mysqli_fetch_array($ejecuta));
              }
              ?>
          </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
  </body>
  <script>
    $(document).ready(function(){
      $('.editM').on('click', function(){
        $('#editar').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function(){
          return $(this).text();
        }).get();
        console.log(data);
        $('#idTipoUsuario').val(data[0]);
        $('#tipoUsuario').val(data[1]); 
      });

    });









  </script>





</html>