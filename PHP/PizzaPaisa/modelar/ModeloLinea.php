<?php

class Linea
{
    public $idSabor;
    public $idPedido;
    public $idSabores;
    public $numeroPorciones; // Cumple ^[a-z][a-zA-Z0-9]*$

    public function agregar()
    {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Consulta preparada para verificar existencia
        $query = "SELECT * FROM linea WHERE idPedido = ? AND idSabor = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("ss", $this->idPedido, $this->idSabor);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result->fetch_array()) {
            // Consulta preparada para insertar el registro
            $insertar = "INSERT INTO linea (idSabor, idPedido, numeroPorciones) VALUES (?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param("sss", $this->idSabor, $this->idPedido, $this->numeroPorciones);
            $stmt_insert->execute();
            $stmt_insert->close();

            echo '<script>Swal.fire({
                position: "top",
                icon: "success",
                title: "El Registro en el Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        } else {
            echo '<script>Swal.fire({
                position: "top",
                icon: "info",
                title: "El Registro ya Existe en el Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        }
        $stmt->close();
    }

    public function modificar()
    {
        $c = new Conexion();
        $cone = $c->conectando();

        // Verificar si el idSabor y el idPedido existen en las tablas relacionadas
        $verificarSabor = "SELECT * FROM sabor WHERE idSabor=?";
        $verificarPedido = "SELECT * FROM reserva WHERE idPedido=?";

        $stmtSabor = $cone->prepare($verificarSabor);
        $stmtSabor->bind_param("s", $this->idSabor);
        $stmtSabor->execute();
        $resultSabor = $stmtSabor->get_result();

        $stmtPedido = $cone->prepare($verificarPedido);
        $stmtPedido->bind_param("s", $this->idPedido);
        $stmtPedido->execute();
        $resultPedido = $stmtPedido->get_result();

        if (!$resultSabor->fetch_array()) {
            echo "<script> alert('El idSabor no existe en la tabla Sabor');</script>";
        } elseif (!$resultPedido->fetch_array()) {
            echo "<script> alert('El idPedido no existe en la tabla Pedido');</script>";
        } else {
            $sql = "SELECT * FROM linea WHERE idPedido=?";
            $stmtLinea = $cone->prepare($sql);
            $stmtLinea->bind_param("s", $this->idPedido);
            $stmtLinea->execute();
            $resultLinea = $stmtLinea->get_result();

            if (!$resultLinea->fetch_array()) {
                echo "<script> alert('El Registro no Existe en el Sistema');</script>";
            } else {
                $id = "UPDATE linea SET idSabor=?, numeroPorciones=? WHERE idPedido=? AND idSabor=?";
                $stmt_update = $cone->prepare($id);
                $stmt_update->bind_param("ssss", $this->idSabor, $this->numeroPorciones, $this->idPedido, $this->idSabores);
                if ($stmt_update->execute()) {
                    echo '<script> 
                        Swal.fire({
                            position: "top",
                            icon: "success",
                            title: "El Registro Fue Actualizado Correctamente",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    </script>';
                } else {
                    echo "<script> alert('Error al actualizar el registro');</script>";
                }
                $stmt_update->close();
            }
            $stmtLinea->close();
        }
        $stmtSabor->close();
        $stmtPedido->close();
    }

    public function eliminar()
    {
        try {
            $c = new Conexion();
            $cone = $c->conectando();
            $sql = "DELETE FROM linea WHERE idSabor=? AND idPedido=?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("ss", $this->idSabor, $this->idPedido);
            $stmt->execute();
            $stmt->close();
            echo '<script>Swal.fire({
                position: "top",
                icon: "success",
                title: "El Registro Fue Eliminado del Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        } catch (Exception $e) {
            echo '<script> Swal.fire({
                position: "top",
                icon: "warning",
                title: "El Registro no se Puede Eliminar Porqué Tiene Datos Relacionados",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        }
    }
}

?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>