<?php

class ordeningrediente
{
    public $idOrden;
    public $idIngrediente;
    public $cantidadSolicitada;
    public $idProveedor;
    public $cantidadComprada;
    public $fechaCompra;

    function agregar()
    {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Consulta preparada para verificar existencia
        $query = "SELECT * FROM ordeningrediente WHERE idOrden = ? AND idIngrediente = ? AND idProveedor = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("sss", $this->idOrden, $this->idIngrediente, $this->idProveedor);
        $stmt->execute();
        $ejecuta = $stmt->get_result();

        if (!$ejecuta->fetch_array()) {
            // Consulta preparada para insertar
            $insertar = "INSERT INTO ordeningrediente (idOrden, idIngrediente, CantidadSolicitada, idProveedor, CantidadComprada, FechaCompra) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param(
                "ssssss",
                $this->idOrden,
                $this->idIngrediente,
                $this->cantidadSolicitada,
                $this->idProveedor,
                $this->cantidadComprada,
                $this->fechaCompra
            );
            if ($stmt_insert->execute()) {
                echo '<script> Swal.fire({
                        position: "top",
                        icon: "success",
                        title: "El Registro Fue Agregado al Sistema",
                        showConfirmButton: false,
                        timer: 3000
                      }); </script>';
            } else {
                echo '<script> Swal.fire({
                        position: "top",
                        icon: "error",
                        title: "Error agregando el registro",
                        showConfirmButton: false,
                        timer: 3000
                      }); </script>';
            }
            $stmt_insert->close();
        } else {
            echo '<script> Swal.fire({
                    position: "top",
                    icon: "info",
                    title: "El Registro ya Existe en el Sistema",
                    showConfirmButton: false,
                    timer: 3000
                  }); </script>';
        }
        $stmt->close();
    }

    function modificar()
    {
        $c = new Conexion();
        $cone = $c->conectando();

        // Consulta preparada para verificar existencia
        $sql = "SELECT * FROM ordeningrediente WHERE idOrden = ? AND idIngrediente = ? AND idProveedor = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("sss", $this->idOrden, $this->idIngrediente, $this->idProveedor);
        $stmt->execute();
        $r = $stmt->get_result();

        if (!$r->fetch_array()) {
            echo "<script> alert('El Usuario no Existe en el Sistema') </script>";
        } else {
            // Consulta preparada para actualizar
            $id = "UPDATE ordeningrediente SET 
                    CantidadSolicitada = ?, 
                    CantidadComprada = ?, 
                    FechaCompra = ?
                WHERE idOrden = ? AND idIngrediente = ? AND idProveedor = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param(
                "ssssss",
                $this->cantidadSolicitada,
                $this->cantidadComprada,
                $this->fechaCompra,
                $this->idOrden,
                $this->idIngrediente,
                $this->idProveedor
            );
            if ($stmt_update->execute()) {
                echo '<script> Swal.fire({
                        position: "top",
                        icon: "success",
                        title: "El Registro Fue Actualizado en el Sistema",
                        showConfirmButton: false,
                        timer: 3000
                      }); </script>';
            } else {
                echo "<script> alert('Ocurrió un error actualizando el registro.') </script>";
            }
            $stmt_update->close();
        }
        $stmt->close();
    }

    function eliminar()
    {
        try {
            $c = new Conexion();
            $cone = $c->conectando();
            // Consulta preparada para eliminar
            $sql = "DELETE FROM ordeningrediente WHERE idOrden = ? AND idIngrediente = ? AND idProveedor = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("sss", $this->idOrden, $this->idIngrediente, $this->idProveedor);
            if ($stmt->execute()) {
                echo '<script> Swal.fire({
                        position: "top",
                        icon: "success",
                        title: "El Registro Fue Eliminado del Sistema",
                        showConfirmButton: false,
                        timer: 3000
                      }); </script>';
            } else {
                echo '<script> Swal.fire({
                        position: "top",
                        icon: "warning",
                        title: "El Registro no se Puede Eliminar Porque Tiene Datos Relacionados",
                        showConfirmButton: false,
                        timer: 3000
                      }); </script>';
            }
            $stmt->close();
        } catch (Exception $e) {
            echo '<script> Swal.fire({
                    position: "top",
                    icon: "warning",
                    title: "El Registro no se Puede Eliminar Porque Tiene Datos Relacionados",
                    showConfirmButton: false,
                    timer: 3000
                  }); </script>';
        }
    }
}

?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>