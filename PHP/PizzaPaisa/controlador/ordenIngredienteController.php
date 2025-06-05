<?php
include('../../modelar/ordenIngredienteModel.php');

$obj = new ordeningrediente();
if($_POST){
}

if(isset($_POST['guardar'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->CantidadSolicitada = $_POST['CantidadSolicitada'];
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->CantidadComprada = $_POST['CantidadComprada'];
    $obj->FechaCompra = $_POST['FechaCompra'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->CantidadSolicitada = $_POST['CantidadSolicitada'];
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->CantidadComprada = $_POST['CantidadComprada'];
    $obj->FechaCompra = $_POST['FechaCompra'];
    $obj->modificar();
    
}

if(isset($_POST['elimina'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->CantidadSolicitada = $_POST['CantidadSolicitada'];
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->CantidadComprada = $_POST['CantidadComprada'];
    $obj->FechaCompra = $_POST['FechaCompra'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from ordeningrediente";
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
    $obj->idOrden = $_POST['idOrden'];
   

  $sql2="select * from ordeningrediente where idOrden LIKE '%$obj->idOrden%' limit $desde,$maximoRegistros ";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
    $sql2 = "select s.idOrden, sa.idOrden as idOrdenOrdenIngrediente, i.idIngrediente, i.Descripcion, o.idProveedor, o.idProveedor 
    from ordeningrediente sa 
    inner join ordendecompra s on s.idOrden = sa.idOrden 
    inner join ingrediente i on i.idIngrediente = sa.idIngrediente 
    inner join proveedor o on o.idProveedor = sa.idProveedor 
    ORDER BY s.idOrden ASC limit $desde, $maximoRegistros";
    $ejecuta=mysqli_query($c,$sql2);
    $res = mysqli_fetch_array($ejecuta);
  }



?>