<?php 
include("../../conectar/conexion.php");
session_start();

    $varsesion = $_SESSION['Correo'];
    

if($varsesion == null ||$varsesion == ''){
    
    header("Location: /PizzaPaisa/Vista/inciarSesion.php");
       echo 'UD NO TIENE AUTORIZACION ';
     
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lading.css">
    <link rel="stylesheet" href="../../Config/css/bootstrap.min.css">
    <script href="../Config/js/bootstrap.min.js"></script>
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
            

            // Añadir evento de clic a cada enlace
            links.forEach(function(link) {
                link.addEventListener('click', function() {
                    iframe.style.display = 'flex'; // Mostrar el iframe
                     // Aplicar overflow:hidden al body
                     
                    document.getElementById( 'artDescripcion' ).style.display = 'none';
                });
            });
        });

        
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
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../../Vista/inciarSesion.php" >Iniciar Sesion</a></li>
                                <li><a class="dropdown-item table-hover" id="elhover" style="color: white;" target="contenido-iframe" href="../VistaUsuario/Registrarse.php" >Registrarse</a></li>
                                <li><a class="dropdown-item" id="elhover" style="color: white;"  href="../VistaUsuario/UsuarioAdmin.php">Pizzero</a></li>
                                <li><a class="dropdown-item" id="elhover" style="color: white;" href="../logout.php">Cerrar Sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
       
    </div>
   
    <main>
    <iframe name="contenido-iframe" width="100%" height="" title="Iframe de Contenido">
            
            </iframe>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        
    <section class="d-flex  justify-content-center align-items-center text-center  aEsconder" id="hoho">
        <article class="artDescripcion" id="artDescripcion">
            <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner" id="bueno">
                    <div class="carousel-item active" id="bueno1">
                        <img src="../../Imagenes/Pizza-descripcion.jpeg" id="imagencarru" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../../Imagenes/buenlogo.jfif" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../../Imagenes/pizzaDesc2.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="container">
                <div class="d-flex flex-column justify-content-center align-items-center text-center"
                    style="min-height: 200px;">
                    <h2 class="p-2" style="font-weight: bold; color: white;">¡Bienvenidos a la Mejor Pizzería!</h2>
                    <p class="p-2" style="color: white;">Disfruta de nuestras deliciosas pizzas artesanales hechas con
                        los mejores ingredientes.</p>
                    <button type="button" class="btn p-2"
                        style="background-color: #239227; color:white; font-weight: bold;">Ordena Ahora</button>
                </div>
            </div>

        </article>
    </section>
    </main>
    <footer class="container-fluid d-flex justify-content-center align-items-center" style="background-color: #239227;  height: 50px; margin-top: auto; ">
        <p class="pt-3"  style="color: white; font-weight: bold;">@La mejor pizza de pais</p>
    </footer>

</body>

</html>