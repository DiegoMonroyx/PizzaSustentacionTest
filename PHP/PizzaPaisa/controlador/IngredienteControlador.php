<?php
include_once '../../modelar/IngredienteModelo.php';
$obj = new Ingrediente();

if(isset($_POST['guardar'])){
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->Descripcion = $_POST['Descripcion'];
    $obj->Existenciaskg = $_POST['Existenciaskg'];
    $obj->agregar();
}
if(isset($_POST['modifica'])){
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->Descripcion = $_POST['Descripcion'];
    $obj->Existenciaskg = $_POST['Existenciaskg'];
    $obj->modificar();
}
if(isset($_POST['elimina'])){
    $obj->idIngrediente = $_POST['idIngrediente'];
    $obj->eliminar();
}
$cone  = new Conexion();
$c = $cone->conectando();

if(isset($_POST['buscar'])){
    $obj->idIngrediente = $_POST['idIngrediente'];
    // Usar consulta preparada para evitar SQL Injection
    $stmt = $c->prepare("SELECT * FROM ingrediente WHERE idIngrediente LIKE ?");
    $search = "%{$obj->idIngrediente}%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT * FROM ingrediente";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}
?>