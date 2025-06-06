<?php
class tipodocumento {
    public $idTipoDocumento;
    public $tipoDocumento;

    function modificar() {
        $c = new Conexion();
        $cone = $c->conectando();

        // Consulta preparada para evitar inyección SQL
        $sql = "SELECT * FROM tipodocumento WHERE idTipoDocumento = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("s", $this->idTipoDocumento);
        $stmt->execute();
        $r = $stmt->get_result();

        if (!$r->fetch_array()) {
            echo "<script> alert('No se puede modificar el tipo de usuario') </script>";
        } else {
            // Actualizar usando consulta preparada
            $id = "UPDATE tipodocumento SET 
                idTipoDocumento = ?, 
                tipoDocumento = ?
                WHERE idTipoDocumento = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param("sss", $this->idTipoDocumento, $this->tipoDocumento, $this->idTipoDocumento);
            $stmt_update->execute();
            $stmt_update->close();

            echo '<script> Swal.fire({
                position: "top",
                icon: "success",
                title: "El tipo de documento se actualizó con exito",
                showConfirmButton: false,
                timer: 3000}); 
                </script>';
        }
        $stmt->close();
    }
}
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>