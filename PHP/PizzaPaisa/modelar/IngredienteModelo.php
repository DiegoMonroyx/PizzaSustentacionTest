<?php

    class Ingrediente{

        public $idIngrediente;
        public $descripcion;
        public $existenciaskg;

        public function agregar(){
            $conet = new Conexion();
            $c = $conet->conectando();

            // Verifica si el ingrediente ya existe usando consulta preparada
            $query = "SELECT * FROM ingrediente WHERE idIngrediente = ?";
            $stmt = $c->prepare($query);
            $stmt->bind_param("s", $this->idIngrediente);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result && $result->fetch_array()){
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "info",
                    title: "El Ingrediente ya Existe en el Sistema",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            } else {
                // Inserta el nuevo ingrediente usando consulta preparada
                $insertar = "INSERT INTO ingrediente VALUES (?, ?, ?)";
                $stmt_insert = $c->prepare($insertar);
                $stmt_insert->bind_param("sss", $this->idIngrediente, $this->descripcion, $this->existenciaskg);
                $stmt_insert->execute();
                $stmt_insert->close();
                echo '<script>
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        title: "El Ingrediente Fue Agregado en el Sistema",
                        showConfirmButton: false,
                        timer: 3000
                    });
                </script>';
            }
            $stmt->close();
        }

        public function modificar(){
            $c = new Conexion();
            $cone = $c->conectando();

            // Verifica si el ingrediente existe
            $sql = "SELECT * FROM ingrediente WHERE idIngrediente = ?";
            $stmt = $cone->prepare($sql);
            $stmt->bind_param("s", $this->idIngrediente);
            $stmt->execute();
            $result = $stmt->get_result();

            if(!$result || !$result->fetch_array()){
                echo "<script> alert('El ingrediente no existe en el Sistema')</script>";
            } else {
                // Actualiza usando consulta preparada
                $id = "UPDATE ingrediente SET 
                    descripcion = ?,
                    existenciaskg = ?
                    WHERE idIngrediente = ?";
                $stmt_update = $cone->prepare($id);
                $stmt_update->bind_param("sss", $this->descripcion, $this->existenciaskg, $this->idIngrediente);
                $stmt_update->execute();
                $stmt_update->close();
                echo '<script>
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        title: "El Ingrediente Fue Actualizado en el Sistema",
                        showConfirmButton: false,
                        timer: 10000
                    });
                </script>';
            }
            $stmt->close();
        }

        public function eliminar(){
            try{
                $c = new Conexion();
                $cone = $c->conectando();

                // Elimina usando consulta preparada
                $sql = "DELETE FROM ingrediente WHERE idIngrediente = ?";
                $stmt = $cone->prepare($sql);
                $stmt->bind_param("s", $this->idIngrediente);
                $stmt->execute();
                $stmt->close();

                echo '<script>Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "El Ingrediente Fue Eliminado del Sistema",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            }catch(Exception $e){
                echo '<script>Swal.fire({
                    position: "top",
                    icon: "warning",
                    title: "El Ingrediente no se Puede Eliminar Porque Tiene Datos Relacionados",
                    showConfirmButton: false,
                    timer: 3000
                });</script>';
            }
        }
    }

?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>