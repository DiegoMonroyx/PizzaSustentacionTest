<?php

    class ordeningrediente{

                    public $idOrden;
                    public $idIngrediente;
                    public $CantidadSolicitada;
                    public $idProveedor;
                    public $CantidadComprada;
                    public $FechaCompra;
                    
                    

                    function agregar(){
                        $conet = new Conexion();
                        $c = $conet->conectando();
                        $query = "select * from ordeningrediente where idOrden = '$this->idOrden' and idIngrediente = '$this->idIngrediente' and idProveedor = '$this->idProveedor'";
                        $ejecuta = mysqli_query($c, $query);
                        if (!mysqli_fetch_array($ejecuta)) {
                            $insertar = "insert into ordeningrediente values(
                                '$this->idOrden',
                                '$this->idIngrediente',
                                '$this->CantidadSolicitada',
                                '$this->idProveedor',
                                '$this->CantidadComprada',
                                '$this->FechaCompra'
                                
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
                        $sql = "select * from ordeningrediente where idOrden ='$this->idOrden' and idIngrediente = '$this->idIngrediente 'and idProveedor = '$this->idProveedor'";
                        $r = mysqli_query($cone, $sql);
                        if (mysqli_fetch_array($r)) {
                            echo "<script> alert('El Usuario no Existe en el Sistema') </script>";
                        } else {
                            $id = "update ordeningrediente set 
                                        idOrden = '$this->idOrden',
                                        idIngrediente = '$this->idIngrediente',
                                        CantidadSolicita = '$this->CantidadSolicitada',
                                        idProveedor ='$this->idProveedor',
                                        CantidadComprada = '$this->CantidadComprada',
                                        FechaCompra = '$this->FechaCompra'
                                         
                                    where idOrden = '$this->idOrden' and idIngrediente = '$this->idIngrediente' and idProveedor = '$this->idProveedor'";
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
                            $sql = "delete from ordeningrediente where idOrden = '$this->idOrden' and idIngrediente = '$this->idIngrediente' and idProveedor = '$this->idProveedor'";
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