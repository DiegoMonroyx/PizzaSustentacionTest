<?php
    include("../../conectar/conexion.php");
    include('../../controlador/UsuarioControlador.php');
    include("ModalEditar.php");
   
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elcrud</title>
    <link rel="stylesheet" href="../../Config/css/bootstrap.min.css">
    <link rel="stylesheet" href="../estilos.css">
    <script href="../Config/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/7e532953a9.js" crossorigin="anonymous"></script>
    <script src="function.js"></script>
    <style>
        /* Estilos personalizados */
       
        
        iframe {
            width: 100%;
            height: 100%;
            border: none; /* Remueve los bordes del iframe */
            display: none;
            overflow: auto
        }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener todos los enlaces que deben mostrar el iframe
        var links = document.querySelectorAll('a[target="contenido-iframe"]');
        var iframe = document.querySelector('iframe[name="contenido-iframe"]');
        var mainContent = document.getElementById('mainadmin'); // El contenido principal
        
        // Añadir evento de clic a cada enlace
        links.forEach(function(link) {
            link.addEventListener('click', function() {
                // Mostrar el iframe
                iframe.style.display = 'block'; 
                
                // Ocupar todo el viewport con el iframe
                iframe.style.width = '100vw';
                iframe.style.height = '100vh';

                // Ocultar el contenido principal
                mainContent.style.display = 'none'; 
            });
        });
    });
</script>

        
    </script>
</head>
<body>
<div class="contenedor" id="headeri">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #239227;">
            <div class="container-fluid ">

                <div class="imagenLogo ps-5">
                    <img src="../../Imagenes/Pizza-logo.png" width="60" height="50" alt="">
                </div>
                <h1 class="ps-5" id="ELtitulo">Pizza Paisa</h1>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2  mb-lg-0 ">
                        <li class="nav-item h5 me-4 table-hover " id="hola"><a class="nav-link active " id="navam"  href="landing.php">Inicio</a>
                        </li>
                        <li class="nav-item h5  me-4">
                            <a class="nav-link active" id="navam" aria-current="page" target="contenido-iframe" href="../VistaReserva/Menu.php">Menu</a>
                        </li>
                        <li class="nav-item h5  me-4">
                            <a class="nav-link active " id="navam" href="#" >Contacto</a>
                        </li>
                        <li class="nav-item dropdown h5" id="menuv">
                            <a class="nav-link active" href="#" id="navbarDropdown" target="_blank" style="color: white;" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sesion
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                style="background-color: #239227;">
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../../Vista/VistaReserva/Reserva.php" >Reservas</a></li>
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../VistaLinea/Linea.php" >Linea</a></li>
                                <li><a class="dropdown-item" id="elhover" style="color: white;"  href="../VistaSabor/UsuarioAdmin.php">Usuario</a></li>
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../VistaSabor/sabor.php" >Sabores</a></li>
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../VistaSaborIngrediente/SaborIngrediente.php" >SaborIngrediente</a></li>
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../../Vista/VistaIngrediente/Ingrediente.php" >Ingrediente</a></li>
                                <li><a class="dropdown-item" id="elhover" style="color: white;" href="../logout.php">Cerrar Sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
       
    </div>
    <iframe name="contenido-iframe" width="100%" height="" title="Iframe de Contenido">
            
            </iframe>
    <main id="mainadmin">
    
            
        <!-- Modal -->
        <div class="modal fade" class="botone" id="botoneliminar" name="Eliminar1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Confirmar Eliminacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;">
                            <div class="col-12">
                                    <label for="inputAddress" class="form-label">NumeroDocumento</label>
                                    <input type="text" name="UsuarioDocumento" id="UsuarioDocumento4" class="form-control"  >
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
        <article  class="Cuernavaca">
    <div class="container-md bg-light mt-5 py-4 px-4  localoca" id="yaya" style ="width:1100px; ">
    
            
            
        <div class="container-fluid mb-3 mt-4" id="lolalola">
            
            <form action="" method="post" id="form-buscar">
            <input class=" me-2 " id="mortorbusq" name="UsuarioDocumento" type="search" placeholder="Search" aria-label="Search" style="width:400px;">
            <button class="btn btn-outline-success" name="buscar" value="buscar" type="submit">Search</button>
            </form>
        </div>
        <table  class="table border border-1 border-dark rounded-3 bg-light" id="latabla" >
         <thead class=" " id="succes" style = "background-color: #239227;">
        <tr style ="color: white;" >
            
            <th scope="col">Documento</th>
            <th scope="col">Telefono</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Correo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellid</th>
            <th scope="col">TipoDocumento</th>
            <th scope="col">TipoUsuario</th>
            <th scope="col"></th>

         </tr>
        </thead>
        <tbody>
            <?php
                $GAU = 1;
                if($res == 0){
                    echo "No hay registros";
                }else {
                    do{
            ?>
                <tr>
                
                
                <td><?php echo $res[0]?></td>
                <td><?php echo $res[1]?></td>
                <td >.....</td>
                <td><?php echo $res[3]?></td>
                <td><?php echo $res[4]?></td>
                <td><?php echo $res[5]?></td>
                <td><?php echo $res[6]?></td>
                <td><?php echo $res[7]?></td>
                <td><form  class="d-flex  justify-content-center align-items-center" action="" method="post">
                
                    <button type="button"   class="btn btn-sm btn-danger elimin" ><i class="fa-solid fa-trash"></i></button>
                    
                    <buttom type="button" class="btn btn-sm btn-primary boton editM "   style="color:black;" ><i class="fa-solid fa-pen-to-square"></i></buttom>
                    </form>
                </td>
                
                </tr>
                
            <?php
                    }while($res = mysqli_fetch_array($ejecuta));

                }

         
            ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php 
                    if($pagina!=1){
                    ?>
                    <li class="page-item ">
                        <a class="page-link" href="?pagina=<?php echo 1; ?>"><</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina-1; ?>"><<</a>
                    </li>
                    <?php
                    }
                    for($i=1; $i<=$totalPaginas; $i++){
                        if($i==$pagina){
                            echo'<li class="page-item active" aria-current="page"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';    
                        }
                        else{
                            echo'<li class="page-item "><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>'; 
                        }
                    }
                    if($pagina !=$totalPaginas){
                    ?>
                    
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina+1; ?>">>></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
   
        <footer class="container-fluid d-flex justify-content-center align-items-center" style="background-color: #239227;  height: 50px; margin-top: auto; ">
        <p class="pt-3"  style="color: white; font-weight: bold;">@La mejor pizza de pais</p>
    </footer>    
        
</body>
</html>
<script>
    $(document).ready(function(){

            $('.editM').on('click', function(){
                $('#editar').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children('td').map(function(){
                return $(this).text();    
                }).get();
                console.log(data);
                $('#UsuarioDocumento').val(data[0]);
                $('#UsuarioTelefono').val(data[1]);
                $('#Correo').val(data[3]);
                $('#UsuarioPrimerNombre').val(data[4]);
                $('#UsuarioApellido').val(data[5]);
                $('#idTipoDocumento').val(data[6]);
                $('#idTipoUsuario').val(data[7]);
    

            });

            $('.elimin').on('click', function(){
            $('#botoneliminar').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function(){
            return $(this).text();    
            }).get();
            console.log(data);
            $('#UsuarioDocumento4').val(data[0]);
            


        });

        });
  

        

</script>
