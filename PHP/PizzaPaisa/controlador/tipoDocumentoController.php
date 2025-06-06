<?php
  include_once '../../modelar/tipoDocumentoModel.php';

  $obj = new tipodocumento();

  if (isset($_POST['modifica'])) {
    $obj->idTipoDocumento = $_POST['idTipoDocumento'];
    $obj->tipoDocumento = $_POST['tipoDocumento'];
    $obj->modificar();
  }

  $cone = new Conexion();
  $c = $cone->conectando();

  if (isset($_POST['buscar'])) {
    $obj->idTipoDocumento = $_POST['idTipoDocumento'];
    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM tipodocumento WHERE idTipoDocumento LIKE ?";
    $stmt = $c->prepare($sql2);
    $likeId = "%" . $obj->idTipoDocumento . "%";
    $stmt->bind_param("s", $likeId);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
  } else {
    $sql2 = "SELECT * FROM tipodocumento";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
  }
?>