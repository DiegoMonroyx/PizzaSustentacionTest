<?php
  include('../../modelar/tipoUsuarioModell.php');

  $obj = new tipousuario();


  

  if(isset($_POST['modifica'])){
   $obj->idTipoUsuario = $_POST['idTipoUsuario'];
   $obj->tipoUsuario = $_POST['tipoUsuario'];
   $obj->modificar();
  }
    $cone = new Conexion();
    $c = $cone->conectando();
    if (isset($_POST['buscar'])) {
        $obj->idTipoUsuario = $_POST['idTipoUsuario'];
        $sql2 = "SELECT * FROM tipousuario WHERE idTipoUsuario LIKE '%$obj->idTipoUsuario%0'";
    } else {
        $sql2 = "SELECT * FROM tipousuario"; 
    }
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
  






?>