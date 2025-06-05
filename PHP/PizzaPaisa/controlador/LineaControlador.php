<?php
include('../../modelar/ModeloLinea.php');

$obj = new Linea();
if($_POST){
}

if(isset($_POST['guardar'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idPedido = $_POST['idPedido'];
    $obj->NumeroPorciones = $_POST['NumeroPorciones'];
    
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idSabores = $_POST['idSabores'];
    $obj->idPedido = $_POST['idPedido'];

    $obj->NumeroPorciones = $_POST['NumeroPorciones'];
    $obj->modificar();
    
}

if(isset($_POST['elimina'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idPedido = $_POST['idPedido'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from linea";
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
   

  $sql2="select * from linea where idPedido LIKE '%$obj->idPedido%' limit $desde,$maximoRegistros ";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
         $sql2="select l.idPedido, s.idSabor, Nombre_Pizza, (NumeroPorciones * Precio_Porcion) AS Precio_Porcion, NumeroPorciones, UsuarioDocumento from  linea l inner join reserva r on l.idPedido = r.idPedido
inner join sabor s on l.idSabor = s.idSabor ORDER BY l.idPedido ASC  limit $desde,$maximoRegistros ";
         $ejecuta=mysqli_query($c,$sql2);
         $res = mysqli_fetch_array($ejecuta);
  }

  if(isset($_POST['listar'])){
       
    
    

  }



?>