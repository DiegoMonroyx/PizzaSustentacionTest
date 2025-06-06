<?php
include_once '../../modelar/ordenIngredienteModel.php';

$obj = new ordeningrediente();

if ($_POST) {
    // Aquí puedes manejar lógica general si necesitas antes de los if específicos
}

if(isset($_POST['guardar'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->cantidadSolicitada = $_POST['CantidadSolicitada'];
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->cantidadComprada = $_POST['CantidadComprada'];
    $obj->fechaCompra = $_POST['FechaCompra'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->cantidadSolicitada = $_POST['CantidadSolicitada'];
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->cantidadComprada = $_POST['CantidadComprada'];
    $obj->fechaCompra = $_POST['FechaCompra'];
    $obj->modificar();
}

if(isset($_POST['elimina'])){
    $obj->idOrden = $_POST['idOrden'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->cantidadSolicitada = $_POST['CantidadSolicitada'];
    $obj->idProveedor = $_POST['idProveedor'];
    $obj->cantidadComprada = $_POST['CantidadComprada'];
    $obj->fechaCompra = $_POST['FechaCompra'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c = $cone->conectando();
$sql1 = "SELECT count(*) as totalRegistro FROM ordeningrediente";
$ejecuta1 = mysqli_query($c, $sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 10;

if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

if(isset($_POST['buscar'])){
    $obj->idOrden = $_POST['idOrden'];

    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM ordeningrediente WHERE idOrden LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $likeIdOrden = "%" . $obj->idOrden . "%";
    $stmt->bind_param("sii", $likeIdOrden, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT s.idOrden, sa.idOrden as idOrdenOrdenIngrediente, i.idIngrediente, i.Descripcion, o.idProveedor
        FROM ordeningrediente sa 
        INNER JOIN ordendecompra s ON s.idOrden = sa.idOrden 
        INNER JOIN ingrediente i ON i.idIngrediente = sa.idIngrediente 
        INNER JOIN proveedor o ON o.idProveedor = sa.idProveedor 
        ORDER BY s.idOrden ASC LIMIT $desde, $maximoRegistros";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}

// Puedes agregar aquí el manejo para $_POST['listar'] si lo necesitas

?>