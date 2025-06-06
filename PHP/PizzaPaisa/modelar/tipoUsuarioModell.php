<?php
class tipousuario {
    public $idTipoUsuario;
    public $tipoUsuario;

    function modificar() {
        $c = new Conexion();
        $cone = $c->conectando();

        // Consulta preparada para evitar inyección SQL
        $sql = "SELECT * FROM tipousuario WHERE idTipoUsuario = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("s", $this->idTipoUsuario);
        $stmt->execute();
        $r = $stmt->get_result();

        if (!$r->fetch_array()) {
            echo "<script> alert('No se puede modificar el tipo de usuario') </script>";
        } else {
            // Actualizar usando consulta preparada
            $id = "UPDATE tipousuario SET 
                idTipoUsuario = ?, 
                tipoUsuario = ?
                WHERE idTipoUsuario = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param("sss", $this->idTipoUsuario, $this->tipoUsuario, $this->idTipoUsuario);
            $stmt_update->execute();
            $stmt_update->close();

            echo '<script> Swal.fire({
                position: "top",
                icon: "success",
                title: "El tipo de usuario se actualizó con exito",
                showConfirmButton: false,
                timer: 3000}); 
                </script>';
        }
        $stmt->close();
    }
}
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>