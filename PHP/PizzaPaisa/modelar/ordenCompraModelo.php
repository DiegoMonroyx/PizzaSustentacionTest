<?php

class OrdenDeCompra
{
    public $idOrden;
    public $fechaPedido;
    public $usuarioDocumento;

    public function agregar()
    {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Consulta preparada para verificar existencia
        $query = "SELECT * FROM ordendecompra WHERE idOrden = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("s", $this->idOrden);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->fetch_array()) {
            echo '<script>Swal.fire({position: "top", icon: "info", title: "La orden ya se encuentra en el Sistema", showConfirmButton: false, timer: 3000});</script>';
        } else {
            // Consulta preparada para insertar
            $insertar = "INSERT INTO ordendecompra (idOrden, FechaPedido, UsuarioDocumento) VALUES (?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param("sss", $this->idOrden, $this->fechaPedido, $this->usuarioDocumento);
            if ($stmt_insert->execute()) {
                echo '<script> Swal.fire({position: "top", icon: "success", title: "La orden fue agregada al sistema", showConfirmButton: false, timer: 3000});</script>';
            } else {
                echo '<script> Swal.fire({position: "top", icon: "error", title: "Ocurrió un error agregando la orden", showConfirmButton: false, timer: 3000});</script>';
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }

    public function modificar()
    {
        $c = new Conexion();
        $cone = $c->conectando();

        // Consulta preparada para verificar existencia
        $sql = "SELECT * FROM ordendecompra WHERE idOrden = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("s", $this->idOrden);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result->fetch_array()) {
            echo "<script> alert('La orden no se encuentra en el Sistema')</script>";
        } else {
            // Consulta preparada para actualizar
            $id = "UPDATE ordendecompra SET FechaPedido = ?, UsuarioDocumento = ? WHERE idOrden = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param("sss", $this->fechaPedido, $this->usuarioDocumento, $this->idOrden);
            if ($stmt_update->execute()) {
                echo '<script> Swal.fire({ position: "top", icon: "success", title: "La orden se actualizó con éxito en el Sistema", showConfirmButton: false, timer: 10000});</script>';
            } else {
                echo "<script> alert('Ocurrió un error actualizando la orden.')</script>";
            }
            $stmt_update->close();
        }
        $stmt->close();
    }

    public function eliminar()
    {
        try {
            $c = new Conexion();
            $cone = $c->conectando();
            // Consulta preparada para eliminar
            $sql = "DELETE FROM ordendecompra WHERE idOrden = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("s", $this->idOrden);
            if ($stmt->execute()) {
                echo '<script>Swal.fire({position: "top", icon: "success", title: "La orden se eliminó del Sistema", showConfirmButton: false, timer: 3000});</script>';
            } else {
                echo '<script> Swal.fire({position: "top", icon: "warning", title: "No se pudo eliminar la orden del sistema", showConfirmButton: false, timer: 3000});</script>';
            }
            $stmt->close();
        } catch (Exception $e) {
            echo '<script> Swal.fire({position: "top", icon: "warning", title: "No se pudo eliminar la orden del sistema", showConfirmButton: false, timer: 3000});</script>';
        }
    }
}

?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>