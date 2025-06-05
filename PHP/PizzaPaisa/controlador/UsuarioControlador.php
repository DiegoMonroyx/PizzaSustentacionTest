<?php
include('../../modelar/UsuarioModelo.php');

$obj = new Usuarios();
if($_POST){
}

if(isset($_POST['guardar'])){
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

if(isset($_POST['modifica'])){

    
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->UsuarioTelefono = $_POST['UsuarioTelefono'];
   
    $obj->Correo = $_POST['Correo'];
    $obj->UsuarioPrimerNombre = $_POST['UsuarioPrimerNombre'];
    $obj->UsuarioApellido = $_POST['UsuarioApellido'];
    $obj->idTipoUsuario = $_POST['idTipoUsuario'];
    $obj->idTipoDocumento = $_POST['idTipoDocumento'];
    $obj->modificar();
    
}

if(isset($_POST['elimina'])){
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
    $obj->eliminar();
}

$cone  = new Conexion();
$c=$cone->conectando();
$sql1="select count(*) as totalRegistro from usuario";
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
    $obj->UsuarioDocumento = $_POST['UsuarioDocumento'];
   

  $sql2="select * from usuario where UsuarioDocumento LIKE '%$obj->UsuarioDocumento%' limit $desde,$maximoRegistros ";
  $ejecuta=mysqli_query($c,$sql2);
  $res = mysqli_fetch_array($ejecuta);
  }else{
         $sql2="select UsuarioDocumento, UsuarioTelefono, Contrasena, Correo, UsuarioPrimerNombre, UsuarioApellido, tipoDocumento, tipoUsuario 
         from  usuario u inner join tipodocumento t on u.idTipoDocumento = t.idTipoDocumento
         inner join tipousuario ti on u.idTipoUsuario = ti.idTipoUsuario limit $desde,$maximoRegistros ";
         $ejecuta=mysqli_query($c,$sql2);
         $res = mysqli_fetch_array($ejecuta);
  }

  if(isset($_POST['listar'])){
       
    
    

  }



?>