<?php
include_once '../../modelar/ModeloLinea.php';

$obj = new Linea();

if(isset($_POST['guardar'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idPedido = $_POST['idPedido'];
    $obj->NumeroPorciones = $_POST['NumeroPorciones'];
    $obj->agregar();
}

if(isset($_POST['modifica'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idSabores = $_POST['idSabores'];
    $obj->idPedido = $_POST['idPedido'];
    $obj->NumeroPorciones = $_POST['NumeroPorciones'];
    $obj->modificar();
}

if(isset($_POST['elimina'])){
    $obj->idSabor = $_POST['idSabor'];
    $obj->idPedido = $_POST['idPedido'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from linea";
$ejecuta1=mysqli_query($c,$sql1);
$res1 = mysqli_fetch_array($ejecuta1);
$totalRegistros = $res1['totalRegistro'];
$maximoRegistros = 6;
if(empty($_GET['pagina'])){
    $pagina=1;
}else{
    $pagina=$_GET['pagina'];
}
$desde = ($pagina-1)*$maximoRegistros;
$totalPaginas=ceil($totalRegistros/$maximoRegistros);

if(isset($_POST['buscar'])){
    $obj->idPedido = $_POST['idPedido'];

    // Usar consulta preparada para evitar SQL Injection
    $sql2 = "SELECT * FROM linea WHERE idPedido LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $search = "%" . $obj->idPedido . "%";
    $stmt->bind_param("sii", $search, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
}else{
    $sql2="SELECT l.idPedido, s.idSabor, Nombre_Pizza, (NumeroPorciones * Precio_Porcion) AS Precio_Porcion, NumeroPorciones, UsuarioDocumento 
    FROM linea l 
    INNER JOIN reserva r ON l.idPedido = r.idPedido
    INNER JOIN sabor s ON l.idSabor = s.idSabor 
    ORDER BY l.idPedido ASC  
    LIMIT $desde,$maximoRegistros";
    $ejecuta=mysqli_query($c,$sql2);
    $res = mysqli_fetch_array($ejecuta);
}
?>