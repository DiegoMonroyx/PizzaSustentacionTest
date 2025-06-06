<?php
include_once '../../modelar/ordenCompraModelo.php';

$obj = new OrdenDeCompra();

if(isset($_POST['guardar'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->fechaPedido = $_POST['FechaPedido']; // usa minúscula inicial
    $obj->usuarioDocumento = $_POST['UsuarioDocumento']; // usa minúscula inicial
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->fechaPedido = $_POST['FechaPedido'];
    $obj->usuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->modificar();
}

if(isset($_POST['elimina'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c = $cone->conectando();
$sql1 = "SELECT COUNT(*) as totalRegistro FROM ordendecompra";
$ejecuta1 = mysqli_query($c, $sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 6;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina-1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

if(isset($_POST['buscar'])){
    $obj->idOrden = $_POST['idOrden'];

    // Consulta preparada para buscar seguro
    $sql2 = "SELECT * FROM ordendecompra WHERE idOrden LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $likeIdOrden = "%" . $obj->idOrden . "%";
    $stmt->bind_param("sii", $likeIdOrden, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT * FROM ordendecompra LIMIT $desde, $maximoRegistros";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}
?>