<?php
include('../../modelar/IngredienteModelo.php');

$obj = new Ingrediente();
if($_POST){
}

if(isset($_POST['guardar'])){
    
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->Descripcion = $_POST['Descripcion'];
    $obj->Existenciaskg = $_POST['Existenciaskg'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){

    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->Descripcion = $_POST['Descripcion'];
    $obj->Existenciaskg = $_POST['Existenciaskg'];
    $obj->modificar();
    
}

if(isset($_POST['elimina'])){
    $obj->idIngrediente = $_POST['idIngrediente'];
    
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();

if(isset($_POST['buscar'])){
    $obj->idIngrediente = $_POST['idIngrediente'];
   

  $sql2="select * from ingrediente where idIngrediente LIKE '%$obj->idIngrediente%'";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
         $sql2="select * from ingrediente";
         $ejecuta=mysqli_query($c,$sql2);
         $res = mysqli_fetch_array($ejecuta);
  }

  if(isset($_POST['listar'])){
       
    
    

  }



?>