<?php
include('../../modelar/SaborIngreModelo.php');

$obj = new SaborIngrediente();
if($_POST){
}

if(isset($_POST['guardar'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->Cantidadkg = $_POST['Cantidadkg'];
    
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->idIngredientes = $_POST['idIngredientes'];
    $obj->Cantidadkg = $_POST['Cantidadkg'];
    $obj->modificar();
    
}

if(isset($_POST['elimina'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from saboringrediente";
$ejecuta1=mysqli_query($c,$sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 10;
 if(empty($_GET['pagina'])){
     $pagina=1;
 }else{
     $pagina=$_GET['pagina'];
 }
 $desde = ($pagina-1)*$maximoRegistros;
 $totalPaginas=ceil($totalRegistros/$maximoRegistros);
if(isset($_POST['buscar'])){
    $obj->idPedido = $_POST['idPedido'];
   

  $sql2="select * from saboringrediente where idSabor LIKE '%$obj->idSabor%' limit $desde,$maximoRegistros ";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
         $sql2="select  s.idSabor,Nombre_Pizza, i.idIngrediente, Descripcion, Cantidadkg from  saboringrediente sa inner join sabor s on s.idSabor = sa.idSabor 
 inner join ingrediente i on i.idIngrediente = sa.idIngrediente ORDER BY s.idSabor ASC  limit $desde,$maximoRegistros ";
         $ejecuta=mysqli_query($c,$sql2);
         $res = mysqli_fetch_array($ejecuta);
  }

  if(isset($_POST['listar'])){
       
    
    

  }



?>