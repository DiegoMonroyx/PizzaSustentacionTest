<?php
include_once '../../modelar/SaborIngreModelo.php';

$obj = new SaborIngrediente();

if (isset($_POST['guardar'])) {
    $obj->idSabor = $_POST['idSabor'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->cantidadKg = $_POST['Cantidadkg'];
    $obj->agregar();
}

if (isset($_POST['modifica'])) {
    $obj->idSabor = $_POST['idSabor'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->idIngredientes = $_POST['idIngredientes'];
    $obj->cantidadKg = $_POST['Cantidadkg'];
    $obj->modificar();
}

if (isset($_POST['elimina'])) {
    $obj->idSabor = $_POST['idSabor'];
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->eliminar();
}

$cone = new Conexion();
$c = $cone->conectando();
$sql1 = "SELECT COUNT(*) as totalRegistro FROM saboringrediente";
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

if (isset($_POST['buscar'])) {
    $obj->idSabor = $_POST['idSabor'];

    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM saboringrediente WHERE idSabor LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $likeIdSabor = "%" . $obj->idSabor . "%";
    $stmt->bind_param("sii", $likeIdSabor, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT s.idSabor, Nombre_Pizza, i.idIngrediente, Descripcion, Cantidadkg 
             FROM saboringrediente sa 
             INNER JOIN sabor s ON s.idSabor = sa.idSabor
             INNER JOIN ingrediente i ON i.idIngrediente = sa.idIngrediente 
             ORDER BY s.idSabor ASC  
             LIMIT $desde, $maximoRegistros";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}

if (isset($_POST['listar'])) {
    // tu lógica aquí...
}
?>