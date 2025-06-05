<?php
include("../../conectar/conexion.php");
include('../../controlador/provedorController.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedor</title>
    <link rel="stylesheet" href="../../Config/css/bootstrap.min.css">
    <link rel="stylesheet" href="../estilos.css">
    <script href="../Config/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/7e532953a9.js" crossorigin="anonymous"></script>
    <script src="function.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        iframe {
            width: 50%;
            height: 100%;
            border: none;
            display: none;
            overflow: auto
        }



        .btn-buscar-actualizado {
            border-radius: 8px;
            padding: 0.5rem 1rem;
        }

        .proveedores-title {
            text-align: center;
            font-size: 1.5rem;
        }

        #search {
            width: 50px;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .actions-cell {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
    </style>


</head>

<body>
    <article class="Buscar">
        <div class="container-md bg-light mt-4 py-4 px-4" style="width: 1000px; margin-bottom: 50px;">

            <div class="container-md bg-light py-4 px-4 localoca" style="color: black;">
                <h5 class="proveedores-title">Proveedores</h5>
                <div class="container-fluid mb-3 mt-4" id="busqueda">
                    <form action="" method="post" id="form-buscar" class="d-flex align-items-center">
                        <input class="me-2 flex-grow-1" id="search" name="idProveedor" type="search" placeholder="Buscar proveedor..." aria-label="Search">
                        <button class="btn btn-outline-success btn-buscar-actualizado ms-2" name="buscar" value="buscar" type="submit">Buscar</button>
                        <button type="button" class="btn btn-primary top-border-green ms-3" data-bs-toggle="modal" data-bs-target="#Agregar">Agregar Proveedor</button>
                    </form>
                </div>
                <div class="modal fade" id="Agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nuevo proveedor</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-6">
                                        <label for="idProveedor" class="form-label">Identificación</label>
                                        <input type="number" name="idProveedor" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nombreProveedor" class="form-label">Nombre del proveedor</label>
                                        <input type="text" name="NombreProveedor" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numeroTelefono" class="form-label">Número de teléfono</label>
                                        <input type="text" name="NumeroTelefono" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" name="direccion" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="barrio" class="form-label">Barrio</label>
                                        <input type="text" name="Barrio" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="guardar" class="btn btn-primary top-border-green">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="editar" name="" data-bs-keyboard="false" tabindex="-1" style="color: Black;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" class="" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modificar los datos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row g-3">

                                    <div class="col-md-6">
                                        <label for="inputAddress" class="form-label">Id proveedor</label>
                                        <input type="number" name="idProveedor" id="idProveedor" class="form-control" readonly required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputAddress2" class="form-label">Nombre del proveedor</label>
                                        <input type="text" name="NombreProveedor" id="NombreProveedor" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">Numero de telefono</label>
                                        <input type="number" name="NumeroTelefono" id="NumeroTelefono" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Barrio</label>
                                        <input type="text" name="Barrio" id="Barrio" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" href="UsuarioAdmin.php" name="modifica" class="btn btn-primary top-border-green">modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" class="botone" id="botoneliminar" name="Eliminar1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Eliminar proveedor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: black;">
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">¿Eliminar provedor?</label>
                                        <input type="text" name="idProveedor" id="idProveedor4" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="elimina" class="btn btn-danger">Confirmar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table border border-1 border-dark rounded-3 bg-light" id="tabla">
                <thead class=" " id="succes" style="background-color: #239227;">
                    <tr style="color: white;">

                        <th scope="col">Id Proveedor</th>
                        <th scope="col">Nombre del proveedor</th>
                        <th scope="col">Numero de telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Barrio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $GAU = 1;
                    if ($res == 0) {
                        echo "No hay registros";
                    } else {
                        do {
                    ?>
                            <tr>
                                <td><?php echo $res[0] ?></td>
                                <td><?php echo $res[1] ?></td>
                                <td><?php echo $res[2] ?></td>
                                <td><?php echo $res[3] ?></td>
                                <td><?php echo $res[4] ?></td>
                                <td class="actions-cell">
                                    <form class="d-flex  justify-content-center align-items-center" action="" method="post">
                                        <button type="button" class="btn btn-sm btn-danger elimin"><i class="fa-solid fa-trash"></i></button>
                                        <button type="button" class="btn btn-sm btn-primary boton editM top-border-green" style="color:black;"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        } while ($res = mysqli_fetch_array($ejecuta));
                    }
                    ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pagina != 1) {
                    ?>
                        <li class="page-item ">
                            <a class="page-link" href="?pagina=<?php echo 1; ?>">
                                <
                                    </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">
                                <<
                                    </a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        if ($i == $pagina) {
                            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item "><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($pagina != $totalPaginas) {
                    ?>

                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">>></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $totalPaginas; ?>">></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </article>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <footer class="container-fluid d-flex justify-content-center align-items-center" style="background-color: #239227;  height: 50px; margin-top: auto; ">
        <p class="pt-3" style="color: white; font-weight: bold;">@La mejor pizza de pais</p>
    </footer>

</body>


<script>
    $(document).ready(function() {
        $('.editM').on('click', function() {
            $('#editar').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#idProveedor').val(data[0]);
            $('#NombreProveedor').val(data[1]);
            $('#NumeroTelefono').val(data[2]);
            $('#direccion').val(data[3]);
            $('#Barrio').val(data[4]);
        });

        $('.elimin').on('click', function() {
            $('#botoneliminar').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#idProveedor4').val(data[0]);
        });

    });
</script>

</html>