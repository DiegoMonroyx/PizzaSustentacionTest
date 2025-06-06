<?php

class Sabor {

    public $idSabor;
    public $nombrePizza;
    public $precioPorcion;
    public $correo;

    function agregar() {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Consulta preparada para evitar inyección SQL
        $query = "SELECT * FROM sabor WHERE idSabor = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("i", $this->idSabor);
        $stmt->execute();
        $ejecuta = $stmt->get_result();

        if ($ejecuta && $ejecuta->fetch_array()) {
            echo '<script> Swal.fire({
                position: "top",
                icon: "info",
                title: "El Registro ya Existe en el Sistema",
                showConfirmButton: false,
                timer: 3000
            }); </script>';
        } else {
            $insertar = "INSERT INTO sabor (idSabor, NombrePizza, PrecioPorcion) VALUES (?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param(
                "iss",
                $this->idSabor,
                $this->nombrePizza,
                $this->precioPorcion
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
                    title: "Error al agregar el registro",
                    showConfirmButton: false,
                    timer: 3000
                }); </script>';
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }

    function modificar() {
        $c = new Conexion();
        $cone = $c->conectando();
        $sql = "SELECT * FROM sabor WHERE idSabor = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("i", $this->idSabor);
        $stmt->execute();
        $r = $stmt->get_result();
        if (!$r->fetch_array()) {
            echo "<script> alert('El Usuario no Existe en el Sistema') </script>";
        } else {
            $id = "UPDATE sabor SET 
                NombrePizza = ?, 
                PrecioPorcion = ?
                WHERE idSabor = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param(
                "ssi",
                $this->nombrePizza,
                $this->precioPorcion,
                $this->idSabor
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
                echo '<script> Swal.fire({
                    position: "top",
                    icon: "error",
                    title: "Error al actualizar el registro",
                    showConfirmButton: false,
                    timer: 3000
                }); </script>';
            }
            $stmt_update->close();
        }
        $stmt->close();
    }

    function eliminar() {
        try {
            $c = new Conexion();
            $cone = $c->conectando();
            $sql = "DELETE FROM sabor WHERE idSabor = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("i", $this->idSabor);
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