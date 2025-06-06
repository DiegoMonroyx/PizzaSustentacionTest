<?php
include_once '../../modelar/UsuarioModelo.php';

$obj = new Usuarios();

if ($_POST) {}

if (isset($_POST['guardar'])) {
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->UsuarioTelefono = $_POST['UsuarioTelefono'];
    $obj->Contrasena = $_POST['Contrasena'];
    $obj->Correo = $_POST['Correo'];
    $obj->UsuarioPrimerNombre = $_POST['UsuarioPrimerNombre'];
    $obj->UsuarioApellido = $_POST['UsuarioApellido'];
    $obj->idTipoDocumento = $_POST['idTipoDocumento'];
    $obj->idTipoUsuario = $_POST['idTipoUsuario'];
    $obj->agregar();
}

if (isset($_POST['modifica'])) {
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->UsuarioTelefono = $_POST['UsuarioTelefono'];
    $obj->Correo = $_POST['Correo'];
    $obj->UsuarioPrimerNombre = $_POST['UsuarioPrimerNombre'];
    $obj->UsuarioApellido = $_POST['UsuarioApellido'];
    $obj->idTipoUsuario = $_POST['idTipoUsuario'];
    $obj->idTipoDocumento = $_POST['idTipoDocumento'];
    $obj->modificar();
}

if (isset($_POST['elimina'])) {
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c = $cone->conectando();
$sql1 = "SELECT count(*) as totalRegistro FROM usuario";
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
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    // Consulta preparada para evitar inyección SQL
    $sql2 = "SELECT * FROM usuario WHERE UsuarioDocumento LIKE ? LIMIT ?, ?";
    $stmt = $c->prepare($sql2);
    $likeDoc = "%" . $obj->UsuarioDocumento . "%";
    $stmt->bind_param("sii", $likeDoc, $desde, $maximoRegistros);
    $stmt->execute();
    $ejecuta = $stmt->get_result();
    $res = $ejecuta->fetch_array();
    $stmt->close();
} else {
    $sql2 = "SELECT UsuarioDocumento, UsuarioTelefono, Contrasena, Correo, UsuarioPrimerNombre, UsuarioApellido, tipoDocumento, tipoUsuario 
        FROM usuario u
        INNER JOIN tipodocumento t ON u.idTipoDocumento = t.idTipoDocumento
        INNER JOIN tipousuario ti ON u.idTipoUsuario = ti.idTipoUsuario
        LIMIT $desde, $maximoRegistros";
    $ejecuta = mysqli_query($c, $sql2);
    $res = mysqli_fetch_array($ejecuta);
}

if (isset($_POST['listar'])) {
    // tu lógica aquí...
}
?>