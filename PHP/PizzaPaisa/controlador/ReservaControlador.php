<?php

require_once __DIR__ . "/../modelar/ReservaModelo.php";

$obj = new Reserva();

if(isset($_POST['guardar'])){
    $obj->idPedido = $_POST['idPedido'];
    $obj->fechaHoraRealizacio = $_POST['FechaHoraRealizacio'];
    $obj->entregada = $_POST['Entregada'];
    $obj->fechaHoraEntrega = $_POST['FechaHoraEntrega'];
    $obj->precioTotal = $_POST['PrecioTotal'];
    $obj->usuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idPedido = $_POST['idPedido'];
    $obj->fechaHoraRealizacio = $_POST['FechaHoraRealizacio'];
    $obj->entregada = $_POST['Entregada'];
    $obj->fechaHoraEntrega = $_POST['FechaHoraEntrega'];
    $obj->precioTotal = $_POST['PrecioTotal'];
    $obj->usuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->modificar();
}

if (isset($_POST['idPedido']) && isset($_POST['entregada'])) {
    $obj->idPedido = $_POST['idPedido'];
    $obj->entregada = $_POST['entregada'];

    if ($obj->modificarr()) {
        echo 'success';
    } else {
        echo 'error';
    }
}

if(isset($_POST['elimina'])){
    $obj->idPedido = $_POST['idPedido'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c = $cone->conectando();
$sql1 = "SELECT count(*) as totalRegistro FROM reserva";
$ejecuta1 = mysqli_query($c, $sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 6;

if(empty($_GET['pagina'])){
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

if(isset($_POST['buscar'])){
    $obj->idPedido = $_POST['idPedido'];

    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM reserva WHERE idPedido LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $likeIdPedido = "%" . $obj->idPedido . "%";
    $stmt->bind_param("sii", $likeIdPedido, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT r.idPedido, r.created_at, r.Entregada, r.FechaHoraEntrega, r.PrecioTotal, 
        u.UsuarioDocumento, u.UsuarioPrimerNombre, u.UsuarioApellido FROM reserva r
        INNER JOIN usuario u ON r.UsuarioDocumento = u.UsuarioDocumento
        ORDER BY r.idPedido DESC LIMIT $desde, $maximoRegistros";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}
?>