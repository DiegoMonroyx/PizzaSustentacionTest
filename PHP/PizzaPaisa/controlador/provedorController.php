<?php
   include('../../modelar/provedorModel.php');
   
   $obj = new proveedor();

   
    if(isset($_POST['guardar'])){
        $obj->idProveedor = $_POST['idProveedor'];
        $obj->NombreProveedor = $_POST['NombreProveedor'];
        $obj->NumeroTelefono = $_POST['NumeroTelefono'];
        $obj->direccion = $_POST['direccion'];
        $obj->Barrio = $_POST['Barrio'];
        $obj->agregar();
    }

    if(isset($_POST['modifica'])){

        $obj->idProveedor = $_POST['idProveedor'];
        $obj->NombreProveedor = $_POST['NombreProveedor'];
        $obj->NumeroTelefono = $_POST['NumeroTelefono'];
        $obj->direccion = $_POST['direccion'];
        $obj->Barrio = $_POST['Barrio'];
        $obj->modificar();
        
    }

    if(isset($_POST['elimina'])){
        $obj->idProveedor = $_POST['idProveedor'];
        $obj->eliminar();
    }

    
    $cone  = new Conexion();
    $c=$cone->conectando();
    $sql1="select count(*) as totalRegistro from proveedor";
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
        $obj->idProveedor = $_POST['idProveedor'];
    

    $sql2="select * from proveedor where idProveedor LIKE '%$obj->idProveedor%' limit $desde,$maximoRegistros ";
    $ejecuta=mysqli_query($c,$sql2);
    $res = mysqli_fetch_array($ejecuta);
    }else{
        $sql2="select * from proveedor limit $desde,$maximoRegistros ";
        $ejecuta=mysqli_query($c,$sql2);
        $res = mysqli_fetch_array($ejecuta);
    }


?>