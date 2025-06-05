<?php

    class Linea{

		

                    public $idSabor;

				    public $idPedido;

                    public $idSabores;

                    public $NumeroPorciones;

                    

					
                    function agregar(){
                                        $conet = new Conexion();
                                        $c = $conet->conectando();
                                        $query = "select * from linea where idPedido = '$this->idPedido' and idSabor = '$this->idSabor'";
                                        $ejecuta = mysqli_query($c, $query);
                                        if(!mysqli_fetch_array($ejecuta)){
                                            $insertar = "insert into linea values(
                                                '$this->idSabor',
                                                '$this->idPedido',
                                                '$this->NumeroPorciones'
                                                )";
                                                echo $insertar;
                                                mysqli_query($c,$insertar);
											echo '<script>	Swal.fire({
												position: "top",
												icon: "success",
												title: "El Registro en el Sistema",
												showConfirmButton: false,
												timer: 3000
											  });</script>';
                                        }else{
										   	
                                            echo '<script>	Swal.fire({
												position: "top",
												icon: "info",
												title: "El Registro ya Existe en el Sistema",
												showConfirmButton: false,
												timer: 3000
											  });</script>';
                                            
                                        }

                    }

                    function modificar() {
                        // Crear conexión
                        $c = new Conexion();
                        $cone = $c->conectando();
                    
                        // Verificar si el idSabor y el idPedido existen en las tablas relacionadas
                        $verificarSabor = "SELECT * FROM sabor WHERE idSabor='$this->idSabor'";
                        $verificarPedido = "SELECT * FROM reserva WHERE idPedido='$this->idPedido'";
                    
                        $resultSabor = mysqli_query($cone, $verificarSabor);
                        $resultPedido = mysqli_query($cone, $verificarPedido);
                    
                        if (!mysqli_fetch_array($resultSabor)) {
                            echo "<script> alert('El idSabor no existe en la tabla Sabor');</script>";
                        } elseif (!mysqli_fetch_array($resultPedido)) {
                            echo "<script> alert('El idPedido no existe en la tabla Pedido');</script>";
                        } else {
                            // Verificar si el registro en la tabla 'linea' existe
                            $sql = "SELECT * FROM linea WHERE idPedido='$this->idPedido'";
                            $r = mysqli_query($cone, $sql);
                    
                            if (!mysqli_fetch_array($r)) {
                                echo "<script> alert('El Registro no Existe en el Sistema');</script>";
                            } else {
                                // Actualizar los campos idSabor y NumeroPorciones en la tabla 'linea'
                                $id = "UPDATE linea SET 
                                    idSabor = '$this->idSabor', 
                                    NumeroPorciones = '$this->NumeroPorciones'
                                    WHERE idPedido = '$this->idPedido' and idSabor = '$this->idSabores'";
                                
                                if (mysqli_query($cone, $id)) {
                                    echo $id;
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
                            }
                        }
                    }
                     
                    
                    function eliminar(){
									try{   
									$c = new Conexion();
									$cone = $c->conectando();
									$sql= "delete from linea where idSabor='$this->idSabor' and idPedido ='$this->idPedido'";
									mysqli_query($cone,$sql);
								    echo $sql;
									echo '<script>	Swal.fire({
										position: "top",
										icon: "success",
										title: "El Registro Fue Eliminado del Sistema",
										showConfirmButton: false,
										timer: 3000
									  });</script>';
									

									}catch(Exception $e){
									
																	
										echo'<script> Swal.fire({
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