<?php
  include('../../modelar/tipoDocumentoModel.php');

  $obj = new tipodocumento();
  
  

  if(isset($_POST['modifica'])){
   $obj->idTipoDocumento = $_POST['idTipoDocumento'];
   $obj->tipoDocumento = $_POST['tipoDocumento'];
   $obj->modificar();
  }
    $cone = new Conexion();
    $c = $cone->conectando();
    if (isset($_POST['buscar'])) {
        $obj->idTipoDocumento = $_POST['idTipoDocumento'];
        $sql2 = "SELECT * FROM tipodocumento WHERE idTipoDocumento LIKE '%$obj->idTipoDocumento%0'";
    } else {
        $sql2 = "SELECT * FROM tipoDocumento"; 
    }
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
  






?>