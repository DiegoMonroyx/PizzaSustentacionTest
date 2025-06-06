<?php

class Usuarios
{
    public $UsuarioDocumento;
    public $UsuarioTelefono;
    public $Contrasena;
    public $Correo;
    public $UsuarioPrimerNombre;
    public $UsuarioApellido;
    public $idTipoDocumento;
    public $idTipoUsuario;

    function agregar()
    {
        $conet = new Conexion();
        $c = $conet->conectando();

        // Verifica si ya existe el usuario (consulta preparada)
        $query = "SELECT * FROM usuario WHERE UsuarioDocumento = ?";
        $stmt = $c->prepare($query);
        $stmt->bind_param("s", $this->UsuarioDocumento);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->fetch_array()) {
            echo '<script>Swal.fire({
                position: "top",
                icon: "info",
                title: "El Registro ya Existe en el Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        } else {
            $ContrasenaHash = password_hash($this->Contrasena, PASSWORD_DEFAULT);
            $insertar = "INSERT INTO usuario (UsuarioDocumento, UsuarioTelefono, Contrasena, Correo, UsuarioPrimerNombre, UsuarioApellido, idTipoDocumento, idTipoUsuario)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $c->prepare($insertar);
            $stmt_insert->bind_param(
                "ssssssss",
                $this->UsuarioDocumento,
                $this->UsuarioTelefono,
                $ContrasenaHash,
                $this->Correo,
                $this->UsuarioPrimerNombre,
                $this->UsuarioApellido,
                $this->idTipoDocumento,
                $this->idTipoUsuario
            );
            $stmt_insert->execute();
            $stmt_insert->close();

            echo '<script>Swal.fire({
                position: "top",
                icon: "success",
                title: "El Registro fue agregado en el Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        }
        $stmt->close();
    }

    function modificar()
    {
        $c = new Conexion();
        $cone = $c->conectando();

        $sql = "SELECT * FROM usuario WHERE UsuarioDocumento = ?";
        $stmt = $cone->prepare($sql);
        $stmt->bind_param("s", $this->UsuarioDocumento);
        $stmt->execute();
        $r = $stmt->get_result();

        if (!$r->fetch_array()) {
            echo "<script> alert('El Usuario no Existe en el Sistema')</script>";
        } else {
            $id = "UPDATE usuario SET 
                        UsuarioTelefono = ?,
                        Correo = ?,
                        UsuarioPrimerNombre = ?,
                        UsuarioApellido = ?,
                        idTipoDocumento = ?,
                        idTipoUsuario = ?
                    WHERE UsuarioDocumento = ?";
            $stmt_update = $cone->prepare($id);
            $stmt_update->bind_param(
                "sssssss",
                $this->UsuarioTelefono,
                $this->Correo,
                $this->UsuarioPrimerNombre,
                $this->UsuarioApellido,
                $this->idTipoDocumento,
                $this->idTipoUsuario,
                $this->UsuarioDocumento
            );
            $stmt_update->execute();
            $stmt_update->close();

            echo '<script>Swal.fire({
                position: "top",
                icon: "success",
                title: "El Registro Fue Actualizado en el Sistema",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        }
        $stmt->close();
    }

    function eliminar()
    {
        try {
            $c = new Conexion();
            $cone = $c->conectando();

            $sql = "DELETE FROM usuario WHERE UsuarioDocumento = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("s", $this->UsuarioDocumento);
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
            echo '<script>Swal.fire({
                position: "top",
                icon: "warning",
                title: "El Registro no se Puede Eliminar Porqué Tiene Datos Relacionados",
                showConfirmButton: false,
                timer: 3000
            });</script>';
        }
    }
}

?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>