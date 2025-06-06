<?php
require_once __DIR__ . "/../conectar/conexion.php";

class Reserva {

    public $idPedido;
    public $fechaHoraRealizacio;
    public $entregada;
    public $fechaHoraEntrega;
    public $precioTotal;
    public $usuarioDocumento;
    public $usuarioApellido;

    function agregar() {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Consulta preparada para verificar existencia
        $query = "SELECT * FROM reserva WHERE idPedido = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("i", $this->idPedido);
        $stmt->execute();
        $ejecuta = $stmt->get_result();

        if($ejecuta && $ejecuta->fetch_array()) {
            echo '<script>Swal.fire({
                position: "top",
                icon: "info",
                title: "El Registro ya Existe en el Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        } else {
            // Consulta preparada para insertar
            $insertar = "INSERT INTO reserva (idPedido, FechaHoraRealizacio, Entregada, FechaHoraEntrega, PrecioTotal, UsuarioDocumento) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param(
                "isssds",
                $this->idPedido,
                $this->fechaHoraRealizacio,
                $this->entregada,
                $this->fechaHoraEntrega,
                $this->precioTotal,
                $this->usuarioDocumento
            );
            if ($stmt_insert->execute()) {
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "El Registro Fue Agregado en el Sistema",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            } else {
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "error",
                    title: "Error agregando el registro",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }

    public function modificarr() {
        $conet = new Conexion();
        $c = $conet->conectando();

        $query = "UPDATE reserva SET Entregada = ? WHERE idPedido = ?";
        $stmt = mysqli_prepare($c, $query);

        if (!$stmt) {
            echo json_encode(["status" => "error", "message" => "Error preparando la consulta: " . mysqli_error($c)]);
            exit;
        }

        mysqli_stmt_bind_param($stmt, "ii", $this->entregada, $this->idPedido);
        $resultado = mysqli_stmt_execute($stmt);

        if (!$resultado) {
            echo json_encode(["status" => "error", "message" => "Error ejecutando la consulta: " . mysqli_stmt_error($stmt)]);
            exit;
        }

        mysqli_stmt_close($stmt);

        // Devolver respuesta JSON en vez de HTML
        header('Content-Type: application/json');
        ob_clean();
        echo json_encode(["status" => "success", "message" => "El Registro Fue Actualizado en el Sistema"]);
        exit;
    }

    function modificar() {
        $c = new Conexion();
        $cone = $c->conectando();

        // Consulta preparada para verificar existencia
        $sql = "SELECT * FROM reserva WHERE idPedido = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("i", $this->idPedido);
        $stmt->execute();
        $r = $stmt->get_result();

        if(!$r->fetch_array()) {
            echo "<script> alert('La reserva ya Existe en el Sistema')</script>";
        } else {
            $id = "UPDATE reserva SET 
                    FechaHoraRealizacio = ?, 
                    Entregada = ?, 
                    FechaHoraEntrega = ?, 
                    PrecioTotal = ?, 
                    UsuarioDocumento = ?
                WHERE idPedido = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param(
                "sssdsi",
                $this->fechaHoraRealizacio,
                $this->entregada,
                $this->fechaHoraEntrega,
                $this->precioTotal,
                $this->usuarioDocumento,
                $this->idPedido
            );
            if ($stmt_update->execute()) {
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "El Registro Fue Actualizado en el Sistema",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            } else {
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "error",
                    title: "Error actualizando el registro",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            }
            $stmt_update->close();
        }
        $stmt->close();
    }

    function eliminar() {
        try {
            $c = new Conexion();
            $cone = $c->conectando();
            $sql = "DELETE FROM reserva WHERE idPedido = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("i", $this->idPedido);
            if ($stmt->execute()) {
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "El Registro Fue Eliminado del Sistema",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            } else {
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "warning",
                    title: "El Registro no se Puede Eliminar Porque Tiene Datos Relacionados",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            }
            $stmt->close();
        } catch (Exception $e) {
            echo '<script>Swal.fire({
                position: "top",
                icon: "warning",
                title: "El Registro no se Puede Eliminar Porque Tiene Datos Relacionados",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        }
    }
}
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>