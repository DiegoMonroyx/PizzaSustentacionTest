<?php

class SaborIngrediente
{
    public $idSabor;
    public $idIngrediente;
    public $idIngredientes;
    public $cantidadKg;

    public function agregar()
    {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Consulta preparada para evitar inyección SQL
        $query = "SELECT * FROM saboringrediente WHERE idSabor = ? AND idIngrediente = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("ss", $this->idSabor, $this->idIngrediente);
        $stmt->execute();
        $ejecuta = $stmt->get_result();

        if (!$ejecuta->fetch_array()) {
            $insertar = "INSERT INTO saboringrediente (idSabor, idIngrediente, Cantidadkg) VALUES (?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param("sss", $this->idSabor, $this->idIngrediente, $this->cantidadKg);
            $stmt_insert->execute();
            $stmt_insert->close();

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
                icon: "info",
                title: "El Registro ya Existe en el Sistema",
                showConfirmButton: false,
                timer: 3000
            }); </script>';
        }
        $stmt->close();
    }

    public function modificar()
    {
        $c = new Conexion();
        $cone = $c->conectando();

        // Consulta preparada para verificar existencia
        $sql = "SELECT * FROM saboringrediente WHERE idSabor = ? AND idIngrediente = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("ss", $this->idSabor, $this->idIngredientes);
        $stmt->execute();
        $r = $stmt->get_result();

        if ($r->fetch_array()) {
            // Actualización usando consulta preparada
            $id = "UPDATE saboringrediente SET 
                        idIngrediente = ?, 
                        Cantidadkg = ?
                    WHERE idSabor = ? AND idIngrediente = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param("ssss", $this->idIngrediente, $this->cantidadKg, $this->idSabor, $this->idIngredientes);
            $stmt_update->execute();
            $stmt_update->close();

            echo '<script> Swal.fire({
                position: "top",
                icon: "success",
                title: "El Registro Fue Actualizado en el Sistema",
                showConfirmButton: false,
                timer: 3000
            }); </script>';
        } else {
            echo "<script> alert('El Usuario no Existe en el Sistema') </script>";
        }
        $stmt->close();
    }

    public function eliminar()
    {
        try {
            $c = new Conexion();
            $cone = $c->conectando();

            // Eliminación usando consulta preparada
            $sql = "DELETE FROM saboringrediente WHERE idSabor = ? AND idIngrediente = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("ss", $this->idSabor, $this->idIngrediente);
            $stmt->execute();
            $stmt->close();

            echo '<script> Swal.fire({
                position: "top",
                icon: "success",
                title: "El Registro Fue Eliminado del Sistema",
                showConfirmButton: false,
                timer: 3000
            }); </script>';
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