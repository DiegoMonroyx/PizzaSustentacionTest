<?php
    include("../../conectar/conexion.php");
    include('../../controlador/UsuarioControlador.php');
  

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="../../Config/css/bootstrap.min.css">
    <script src="./Config/js/bootstrap.min.js"></script>

</head>
<body>
   <main>
    <section class="container bg-white  d-flex align-items-center justify-content-center" id="formulario1" >
        <div class=" mt-5 mb-4"> 
            <h2>Registrarse</h2>
        </div>
        
        <form class="row g-3 needs-validation" action="" method="post" id="formulariocam" novalidate>
            
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Primer Nombre</label>
                  <input type="text" name="UsuarioPrimerNombre" class="form-control" id="validationCustom01" value="" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="UsuarioApellido" id="validationCustom02" value="" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
              <div class="col-md-6">
                <label for="exampleInputPassword1"  class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="Contrasena" id="exampleInputPassword1">
              </div>
              <div class="col-md-6">
                <label for="validationCustom03" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="UsuarioTelefono" id="validationCustom03" value="" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="">
                <label for="exampleInputPassword1" class="form-label">Correo</label>
                <input type="email" class="form-control" name="Correo" id="exampleInputPassword1">
              </div>
            <div class="col-md-6">
              <label for="validationCustomUsername"  class="form-label">Documento Identidad</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" id="validationCustomUsername" name="UsuarioDocumento" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Please choose a username.
                </div>
              </div>
            </div>
            
            </div>
            <div class="col-md-6">
              <label for="validationCustom04" class="form-label">TipoDocumento</label>
              <select class="form-select" name="idTipoDocumento" id="validationCustom04" required>
                <option selected disabled value="">Elije...</option>
                <option value="1">Cedula de Ciudadania</option>
                <option value="2">Cedula de Extranjeria</option>
                <option value="3">Numero de Pasaporte</option>
              </select>
              <div class="invalid-feedback">
                Porfavor un tipo de documento valido
              </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom05" class="form-label">TipoUsuario</label>
                <select class="form-select" name="idTipoUsuario" id="validationCustom05" required>
                  <option selected disabled value="">Elije...</option>
                  <option value="1">Gerente</option>
                  <option value="2">Encargado de reservas</option>
                  <option value="3">Cliente</option>
                </select>
                <div class="invalid-feedback">
                  Porfavor un tipo de documento valido
                </div>
              </div>
            
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  Agree to terms and conditions
                </label>
                <div class="invalidd-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div>
            <div class="col-12 ms-d mb-4" >
              <button class="btn btn-primary"  style="width: 100px;" name="guardar" value="guardar" type="submit">Enviar</button>
            </div>
          </form>
    </section>
    </main>
    
</body>
</html>