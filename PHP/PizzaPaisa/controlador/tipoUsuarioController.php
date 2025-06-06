<?php
  include_once '../../modelar/tipoUsuarioModell.php';

  $obj = new tipousuario();

  if (isset($_POST['modifica'])) {
    $obj->idTipoUsuario = $_POST['idTipoUsuario'];
    $obj->tipoUsuario = $_POST['tipoUsuario'];
    $obj->modificar();
  }

  $cone = new Conexion();
  $c = $cone->conectando();

  if (isset($_POST['buscar'])) {
    $obj->idTipoUsuario = $_POST['idTipoUsuario'];
    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM tipousuario WHERE idTipoUsuario LIKE ?";
    $stmt = $c->prepare($sql2);
    $likeId = "%" . $obj->idTipoUsuario . "%";
    $stmt->bind_param("s", $likeId);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
  } else {
    $sql2 = "SELECT * FROM tipousuario";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
  }
?>