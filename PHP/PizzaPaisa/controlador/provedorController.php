<?php
include_once '../../modelar/provedorModel.php';

$obj = new proveedor();

if (isset($_POST['guardar'])) {
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->nombreProveedor = $_POST['NombreProveedor'];
    $obj->numeroTelefono = $_POST['NumeroTelefono'];
    $obj->direccion = $_POST['direccion'];
    $obj->barrio = $_POST['Barrio'];
    $obj->agregar();
}

if (isset($_POST['modifica'])) {
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->nombreProveedor = $_POST['NombreProveedor'];
    $obj->numeroTelefono = $_POST['NumeroTelefono'];
    $obj->direccion = $_POST['direccion'];
    $obj->barrio = $_POST['Barrio'];
    $obj->modificar();
}

if (isset($_POST['elimina'])) {
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c = $cone->conectando();
$sql1 = "SELECT count(*) as totalRegistro FROM proveedor";
$ejecuta1 = mysqli_query($c, $sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 6;

if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

if (isset($_POST['buscar'])) {
    $obj->idProveedor = $_POST['idProveedor'];

    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM proveedor WHERE idProveedor LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $likeIdProveedor = "%" . $obj->idProveedor . "%";
    $stmt->bind_param("sii", $likeIdProveedor, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT * FROM proveedor LIMIT $desde, $maximoRegistros";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}
?>