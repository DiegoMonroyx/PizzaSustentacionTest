<?php

    class Sabor{

                    public $idSabor;
                    public $NombrePizza;
                    public $PrecioPorcion;
                    public $Correo;

                    function agregar(){
                        $conet = new Conexion();
                        $c = $conet->conectando();
                        $query = "select * from sabor where idSabor = '$this->idSabor'";
                        $ejecuta = mysqli_query($c, $query);
                        if (mysqli_fetch_array($ejecuta)) {
                            echo '<script> Swal.fire({
                                    position: "top",
                                    icon: "info",
                                    title: "El Registro ya Existe en el Sistema",
                                    showConfirmButton: false,
                                    timer: 3000
                                  }); </script>';
                        } else {
                            $insertar = "insert into sabor values(
                                            '$this->idSabor',
                                            '$this->NombrePizza',
                                            '$this->PrecioPorcion'
                                        )";
                            echo $insertar;
                            mysqli_query($c, $insertar);
                            echo '<script> Swal.fire({
                                    position: "top",
                                    icon: "success",
                                    title: "El Registro Fue Agregado al Sistema",
                                    showConfirmButton: false,
                                    timer: 3000
                                  }); </script>';
                        }
                    }

                    function modificar(){
                        $c = new Conexion();
                        $cone = $c->conectando();
                        $sql = "select * from sabor where idSabor ='$this->idSabor'";
                        $r = mysqli_query($cone, $sql);
                        if (!mysqli_fetch_array($r)) {
                            echo "<script> alert('El Usuario no Existe en el Sistema') </script>";
                        } else {
                            $id = "update sabor set 
                                        idSabor = '$this->idSabor',
                                        Nombre_Pizza = '$this->NombrePizza',
                                        Precio_Porcion = '$this->PrecioPorcion'
                                    where idSabor = '$this->idSabor'";
                            mysqli_query($cone, $id);
                            echo '<script> Swal.fire({
                                    position: "top",
                                    icon: "success",
                                    title: "El Registro Fue Actualizado en el Sistema",
                                    showConfirmButton: false,
                                    timer: 3000
                                  }); </script>';
                        }
                    }

                    function eliminar(){
                        try {   
                            $c = new Conexion();
                            $cone = $c->conectando();
                            $sql = "delete from sabor where idSabor = '$this->idSabor'";
                            mysqli_query($cone, $sql);
                            echo $sql;
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