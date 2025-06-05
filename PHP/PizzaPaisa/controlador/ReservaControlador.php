<?php

//include('../../modelar/ReservaModelo.php');
require_once(__DIR__ . "/../modelar/ReservaModelo.php");


$obj = new Reserva();
if($_POST){
}

if(isset($_POST['guardar'])){
    
    $obj->idPedido = $_POST['idPedido'];
    $obj->FechaHoraRealizacio = $_POST['FechaHoraRealizacio'];
    $obj->Entregada = $_POST['Entregada'];
    $obj->FechaHoraEntrega = $_POST['FechaHoraEntrega'];
    $obj->PrecioTotal = $_POST['PrecioTotal'];
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){

    
    $obj->idPedido = $_POST['idPedido'];
    $obj->FechaHoraRealizacio = $_POST['FechaHoraRealizacio'];
    $obj->Entregada = $_POST['Entregada'];
    $obj->FechaHoraEntrega = $_POST['FechaHoraEntrega'];
    $obj->PrecioTotal = $_POST['PrecioTotal'];
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->modificar();
    
}

if (isset($_POST['idPedido']) && isset($_POST['entregada'])) {
    $idPedido = $_POST['idPedido'];
    $entregada = $_POST['entregada'];

    // Asignar valores al objeto
    $obj->idPedido = $idPedido;
    $obj->Entregada = $entregada;

    // Ejecutar la actualización
    if ($obj->modificarr()) {
        echo 'success';
    } else {
        echo 'error';
    }
}

if(isset($_POST['elimina'])){
    $obj->idPedido = $_POST['idPedido'];
    
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from reserva";
$ejecuta1=mysqli_query($c,$sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 6;
 if(empty($_GET['pagina'])){
     $pagina=1;
 }else{
     $pagina=$_GET['pagina'];
 }
 $desde = ($pagina-1)*$maximoRegistros;
 $totalPaginas=ceil($totalRegistros/$maximoRegistros);
if(isset($_POST['buscar'])){
    $obj->idPedido = $_POST['idPedido'];
   

  $sql2="select * from reserva where idPedido LIKE '%$obj->idPedido%' limit $desde,$maximoRegistros ";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
         $sql2="select r.idPedido, r.created_at, r.Entregada, r.FechaHoraEntrega, r.PrecioTotal, 
        u.UsuarioDocumento, u.UsuarioPrimerNombre, u.UsuarioApellido from reserva r
        inner join usuario u ON r.UsuarioDocumento = u.UsuarioDocumento
        ORDER BY r.idPedido DESC";
         $ejecuta=mysqli_query($c,$sql2);
         $res = mysqli_fetch_array($ejecuta);
  }

  if(isset($_POST['listar'])){
       
    
    

  }



?>