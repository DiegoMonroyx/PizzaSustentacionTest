
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="modal fade" id="editar" name=""   data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="" style="color: Black;">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="" class="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                                     
                        <div class="col-12">
                                <label for="inputAddress" class="form-label">NumeroDocumento</label>
                                <input type="text" name="UsuarioDocumento" id="UsuarioDocumento" class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">NumeroTelefono</label>
                            <input type="text" name="UsuarioTelefono" id="UsuarioTelefono" class="form-control"  placeholder="">
                        </div>
                        <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Password</label>
                                <input type="password" name="" id="Contrasena" class="form-control" readonly >
                         </div>
                        <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="Correo" id="Correo" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Primer Nombre</label>
                            <input type="text" name="UsuarioPrimerNombre" id="UsuarioPrimerNombre" class="form-control" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="UsuarioApellido" id="UsuarioApellido" value="" required>
                        </div> 
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">TipoDocumento</label>
                            <select class="form-select" name="idTipoDocumento" id="idTipoDocumento" required>
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
                            <select class="form-select" name="idTipoUsuario" id="idTipoUsuario" required>
                            <option selected disabled value="idTipoUsuario">Elije...</option>
                            <option value="1">Gerente</option>
                            <option value="2">Encargado de reservas</option>
                            <option value="3">Cliente</option>
                            </select>
                            
                        </div>
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  href="UsuarioAdmin.php" name="modifica" class="btn btn-primary">modificar</button>
                </div>
            </div>
            </form> 
         </div>
        </div>
</body>
</html>