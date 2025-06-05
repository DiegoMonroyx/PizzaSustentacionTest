<?php
include('../../modelar/ordenCompraModelo.php');


$obj = new ordendecompra();

if(isset($_POST['guardar'])){
    
    $obj->idOrden = $_POST['idOrden'];
    $obj->FechaPedido = $_POST['FechaPedido'];
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){

    $obj->idOrden = $_POST['idOrden'];
    $obj->FechaPedido = $_POST['FechaPedido'];
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->modificar();
    
}

if(isset($_POST['elimina'])){
    $obj->idOrden = $_POST['idOrden'];
    
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from ordendecompra";
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
    $obj->idOrden = $_POST['idOrden'];
   

  $sql2="select * from ordendecompra where idOrden LIKE '%$obj->idOrden%' limit $desde,$maximoRegistros ";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
         $sql2="select * from ordendecompra limit $desde,$maximoRegistros ";
         $ejecuta=mysqli_query($c,$sql2);
         $res = mysqli_fetch_array($ejecuta);
  }

  if(isset($_POST['listar'])){
       
    
    

  }



?>