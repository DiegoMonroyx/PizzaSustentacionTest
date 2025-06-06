<?php
include_once '../../modelar/SaborModelo.php';

$obj = new Sabor();

if ($_POST) {}

if (isset($_POST['guardar'])) {
    $obj->idSabor = $_POST['idSabor'];
    $obj->nombrePizza = $_POST['NombrePizza'];        // Propiedad camelCase
    $obj->precioPorcion = $_POST['PrecioPorcion'];    // Propiedad camelCase
    $obj->agregar();
}

if (isset($_POST['modifica'])) {
    $obj->idSabor = $_POST['idSabor'];
    $obj->nombrePizza = $_POST['NombrePizza'];
    $obj->precioPorcion = $_POST['PrecioPorcion'];
    $obj->modificar();
}

if (isset($_POST['elimina'])) {
    $obj->idSabor = $_POST['idSabor'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c = $cone->conectando();

if (isset($_POST['buscar'])) {
    $obj->idSabor = $_POST['idSabor'];

    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM sabor WHERE idSabor LIKE ?";
    $stmt = $c->prepare($sql2);
    $likeIdSabor = "%" . $obj->idSabor . "%";
    $stmt->bind_param("s", $likeIdSabor);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT * FROM sabor";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}

if (isset($_POST['listar'])) {
    // tu lógica aquí...
}
?>