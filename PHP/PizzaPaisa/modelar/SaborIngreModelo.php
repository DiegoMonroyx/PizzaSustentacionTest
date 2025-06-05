<?php

    class SaborIngrediente{

                    public $idSabor;
                    public $idIngrediente;
                    public $idIngredientes;
                    public $Cantidadkg;
                    

                    function agregar(){
                        $conet = new Conexion();
                        $c = $conet->conectando();
                        $query = "select * from saboringrediente where idSabor = '$this->idSabor' and idIngrediente = '$this->idIngrediente'";
                        $ejecuta = mysqli_query($c, $query);
                        if (!mysqli_fetch_array($ejecuta)) {
                            $insertar = "insert into saboringrediente values(
                                '$this->idSabor',
                                '$this->idIngrediente',
                                '$this->Cantidadkg' 
                            )";
                            echo $insertar;
                            mysqli_query($c, $insertar);
                            echo '<script> Swal.fire({
                                    position: "top",
                                    icon: "info",
                                    title: "El Registro ya Existe en el Sistema",
                                    showConfirmButton: false,
                                    timer: 3000
                                  }); </script>';
                        } else {
                            
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
                        $sql = "select * from saboringrediente where idSabor ='$this->idSabor' and idIngrediente = '$this->idIngrediente'";
                        $r = mysqli_query($cone, $sql);
                        if (mysqli_fetch_array($r)) {
                            echo "<script> alert('El Usuario no Existe en el Sistema') </script>";
                        } else {
                            $id = "update saboringrediente set 
                                        idIngrediente = '$this->idIngrediente',
                                        Cantidadkg = '$this->Cantidadkg'
                                    where idSabor = '$this->idSabor' and idIngrediente = '$this->idIngredientes'";
                            mysqli_query($cone, $id);
                            echo $id;
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
                            $sql = "delete from saboringrediente where idSabor = '$this->idSabor' and idIngrediente = '$this->idIngrediente'";
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