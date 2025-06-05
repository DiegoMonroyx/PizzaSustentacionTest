<?php
    include("../../conectar/conexion.php");
    include('../../controlador/ReservaControlador.php');
    
   
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
</head>
<body>
    <main id="mainadmin">
    
      <div class="modal fade" id="Reservar" name=""   data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="" style="color: Black;">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="" class="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                                     
                        <div class="col-md-6">
                                <label for="inputAddress" class="form-label">Pedido</label>
                                <input type="text" name="idPedido" id="" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress2" class="form-label">Fecha Realizacion</label>
                            <input type="datetime-local" name="FechaHoraRealizacio" id="" class="form-control"  placeholder="">
                        </div>
                        <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Entregado</label>
                                <input type="text" name="Entregada" id="" value="NO" class="form-control" readonly >
                         </div>
                        <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Fecha/hora de entrega</label>
                                <input type="datetime-local" name="FechaHoraEntrega" id="" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">PrecioTotal</label>
                            <input type="number" name="PrecioTotal" id="" class="form-control" value="0" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Numero de Documento</label>
                            <input type="text" class="form-control" name="UsuarioDocumento" id="" value="" required>
                        </div> 
                        
                        
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit"  href="UsuarioAdmin.php" name="guardar" class="btn btn-primary">Reservar</button>
                </div>
            </div>
            </form> 
         </div>
        </div>


<!-- modal editar-->
    <div class="modal fade" id="editar" name=""   data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="" style="color: Black;">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="" class="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modificar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                                     
                        <div class="col-md-6">
                                <label for="inputAddress" class="form-label">Pedido</label>
                                <input type="text" name="idPedido" id="idPedido" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress2" class="form-label">Fecha Realizacion</label>
                            <input type="text" name="FechaHoraRealizacio" id="FechaHoraRealizacio" class="form-control"  placeholder="">
                        </div>
                        <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Entregado</label>
                                <input type="number" name="Entregada" id="Entregada" class="form-control"  >
                         </div>
                        <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Fecha/hora de entrega</label>
                                <input type="text" name="FechaHoraEntrega" id="FechaHoraEntrega" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">PrecioTotal</label>
                            <input type="number" name="PrecioTotal" id="PrecioTotal" class="form-control" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Numero de Documento</label>
                            <input type="text" class="form-control" name="UsuarioDocumento" id="UsuarioDocumento" value="" required>
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
                                    <label for="inputAddress" class="form-label">idPedido</label>
                                    <input type="text" name="idPedido" id="idPedido1" class="form-control"  >
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
        
    <div class="container-md bg-light mt-5 py-4 px-4" id="catlos" style ="width:1100px; ">
    
            
            
        <div class="container-fluid mb-3 mt-4 d-flex justify-content-between ">
            
            <form action="" method="post" id="form-buscar">
            <input class=" me-2 " id="mortorbusq" name="idPedido" type="search" placeholder="Search" aria-label="Search" style="width:400px;">
            <button class="btn btn-outline-success" name="buscar" value="buscar" type="submit">Search</button>
            </form>
            
           <!-- <button type="button"  class="btn btn-primary d-flex  m-3  " style="height:20px ;" data-bs-toggle="modal" data-bs-target="#Reservar">
            Reserva
            </button> -->
           
        </div>
        
        <table  class="table border border-1 border-dark rounded-3 bg-light" id="latabla" >
         <thead class=" " id="succes" style = "background-color: #239227;">
        <tr style ="color: white;" >
            
            <th scope="col">Pedido</th>
            <th scope="col">FechoRealizacion</th>
            <th scope="col">Entregada</th>
            <th scope="col">FechaHoraEntrega</th>
            <th scope="col">PrecioTotal</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Accion</th>
           
            

         </tr>
        </thead>
        <tbody>
            <?php
                $GAU = 1;
                if($res == 0){
                    echo "No hay registros";
                }else {
                    do{
                        $pedidoID = $res[0];
            ?>
                <tr>
                
                
                <td><?php echo $pedidoID?></td>
                <td><?php echo $res[1]?></td>
                <td>
                    <?php
                    if ($res[2] == 1) {
                        echo '<button class="btn btn-success btn-sm btn-entregada" data-id="' . $res[0] . '" data-entregada="1">Entregado</button>';
                    } else {
                    echo '<button class="btn btn-warning btn-sm btn-entregada" data-id="' . $res[0] . '" data-entregada="0">No Entregado</button>';
                    }
                    ?>
                </td>
                <td><?php echo $res[3]?></td>
                <td><?php echo $res[4]?></td>
                <td><?php echo $res[6]?></td>
                <td><?php echo $res[7]?></td>
                
                <td><form  class="d-flex  justify-content-center align-items-center" action="" method="post">
                <button type="button" class="btn btn-sm btn-success toggle-details" data-id="<?php echo $pedidoID; ?>">
                    <i class="fa-solid fa-eye"></i>
                </button>
                    <button type="button"   class="btn btn-sm btn-danger elimin" ><i class="fa-solid fa-trash"></i></button>
                    
                    <buttom type="button" class="btn btn-sm btn-primary boton editM "   style="color:black;" ><i class="fa-solid fa-pen-to-square"></i></buttom>
                    </form>
                </td>
                
                </tr>
                <tr class="detalle-pedido" id="detalle-<?php echo $pedidoID; ?>" style="display:none;">
            <td colspan="8">
                <div class="detalle-contenedor" style="margin:auto 25%; flex-direction: center;">
                    <div class="detalle-con">
                    </div>
                    <table class="table">
                        <thead class="detalle-con">
                            <tr>
                                <th>ID Sabor</th>
                                <th>Nombre de la Pizza</th>
                                <th>Cantidad de Porciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Aquí puedes hacer otra consulta para obtener los detalles del pedido
                                $detalleSQL = "SELECT l.idSabor, Nombre_Pizza, l.NumeroPorciones FROM linea l JOIN sabor s ON l.idSabor = s.idSabor WHERE l.idPedido = '$pedidoID'";
                                $c = new Conexion();
								$cone = $c->conectando();
                                $detalleEjecuta = mysqli_query($cone, $detalleSQL);
                                if ($detalleEjecuta) {
                                while ($detalle = mysqli_fetch_assoc($detalleEjecuta)) {
                            ?>
                                    <tr>
                                        <td><?php echo $detalle['idSabor']; ?></td>
                                        <td><?php echo $detalle['Nombre_Pizza']; ?></td>
                                        <td><?php echo $detalle['NumeroPorciones']; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'>No hay detalles disponibles</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
                    //if($pagina!=1){
                    ?>
                    <!--- <li class="page-item ">
                      <a class="page-link" href="?pagina=<?php echo 1; ?>"><</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina-1; ?>"><<</a>
                    </li>
                    //<?php
                    //} 
                    // for($i=1; $i<=$totalPaginas; $i++){
                        //if($i==$pagina){
                          //  echo'<li class="page-item active" aria-current="page"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';    
                       // }
                        //else{
                         //   echo'<li class="page-item "><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>'; 
                       // }
                    //}
                   // if($pagina !=$totalPaginas){
                    ?>
                    
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina+1; ?>">>></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $totalPaginas; ?>">></a>
                    </li>
                    <?php
                   // }
                    ?>
                </ul> -->
            </nav>
</div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
   
    
        
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
                $('#idPedido').val(data[0]);
                $('#FechaHoraRealizacio').val(data[1]);
                $('#Entregada').val(data[2]);
                $('#FechaHoraEntrega').val(data[3]);
                $('#PrecioTotal').val(data[4]);
                $('#UsuarioDocumento').val(data[5]);
                
    

            });

            $('.elimin').on('click', function(){
            $('#botoneliminar').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function(){
            return $(this).text();    
            }).get();
            console.log(data);
            $('#idPedido1').val(data[0]);
            


        });

        });
  

        //sss
        document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los botones de "ver detalles"
    document.querySelectorAll(".toggle-details").forEach(button => {
        button.addEventListener("click", function () {
            let pedidoID = this.getAttribute("data-id");
            let detalleRow = document.getElementById(`detalle-${pedidoID}`);

            // Alternar visibilidad
            if (detalleRow.style.display === "none" || detalleRow.style.display === "") {
                detalleRow.style.display = "table-row"; // Muestra la fila
            } else {
                detalleRow.style.display = "none"; // Oculta la fila
            }
        });
    });
});

document.getElementById("catlos").addEventListener("click", function() {
    this.classList.toggle("expandido");
});


//boton de entregado

$(document).ready(function() {
    $(".btn-entregada").click(function() {
        let button = $(this);
        let idPedido = button.data("id");
        let nuevoEstado = button.data("entregada") == "1" ? "0" : "1";

        $.ajax({
            url: "../../controlador/ReservaControlador.php",
            type: "POST",
            data: { idPedido: idPedido, entregada: nuevoEstado },
            dataType: "json",  // 👈 Esto indica a jQuery que la respuesta es JSON
            success: function(response) {
                console.log("Respuesta del servidor:", response); // 🔍 Depuración en consola

                if (response.status === "success") { // 👈 Acceder directamente al JSON
                    Swal.fire({
                        icon: "success",
                        title: "Estado Actualizado",
                        text: response.message, // Mostrar mensaje del servidor
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Actualizar botón visualmente
                    if (nuevoEstado == "1") {
                        button.removeClass("btn-warning").addClass("btn-success").text("Entregado");
                        button.data("entregada", "1");
                    } else {
                        button.removeClass("btn-success").addClass("btn-warning").text("No Entregado");
                        button.data("entregada", "0");
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message || "No se pudo actualizar el estado del pedido."
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error en AJAX:", error); // 🔍 Verificar errores en consola
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Hubo un problema con la solicitud."
                });
            }
        });
    });
});
</script>
