<?php
  class tipodocumento{
    public $idTipoDocumento;
    public $tipoDocumento;


    function modificar(){

        $c = new Conexion();
        $cone = $c->conectando();
        $sql = "select * from tipodocumento where idTipoDocumento = '$this->idTipoDocumento'";
        $r = mysqli_query($cone, $sql);
        if (!mysqli_fetch_array($r)) {
            echo "<script> alert ('No se puede modificar el tipo de usuario') </script>";
        } else {
          $id = "update tipodocumento set 
            idTipoDocumento = '$this->idTipoDocumento',
            tipoDocumento = '$this->tipoDocumento'
            where idTipoDocumento = '$this->idTipoDocumento'";
            mysqli_query($cone, $id);
            echo '<script> Swal.fire({
                position: "top",
                icon: "success",
                title: "El tipo de documento se actualizó con exito",
                showConfirmButton: false,
                timer: 3000}); 
                </script>';
        }
    }

  }


?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>