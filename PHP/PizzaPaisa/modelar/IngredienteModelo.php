<?php

    class Ingrediente{

		

                    public $idIngrediente;

				    public $Descripcion;

                    public $Existenciaskg;

                    

                    

					
                    function agregar(){
                                        $conet = new Conexion();
                                        $c = $conet->conectando();
                                        $query = "select * from ingrediente where idIngrediente = '$this->idIngrediente'";
                                        $ejecuta = mysqli_query($c, $query);
                                        if(mysqli_fetch_array($ejecuta)){
											echo '<script>	Swal.fire({
												position: "top",
												icon: "info",
												title: "El Ingrediente ya Existe en el Sistema",
												showConfirmButton: false,
												timer: 3000
											  });';
                                        }else{
										   	
                                           $insertar = "insert into ingrediente values(                                                                              
																					'$this->idIngrediente',
                                                                                    '$this->Descripcion',
																					'$this->Existenciaskg'                                                                                                                                                                             
                                                                                    
                                           )";
                                           echo $insertar;
                                           mysqli_query($c,$insertar);
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

                    }

                    function modificar(){
                                    $c = new Conexion();
								    $cone = $c->conectando();
									$sql = "select * from ingrediente where idIngrediente ='$this->idIngrediente'";
									$r = mysqli_query($cone,$sql);
									if(!mysqli_fetch_array($r))
																{
																	echo "<script> alert('El ingrediente ya Existe en el Sistema')</scrip>";
																}
																else
																	{
																	$id = "update ingrediente set 
																	idIngrediente ='$this->idIngrediente',
																	Descripcion = '$this->Descripcion',
																	Existenciaskg = '$this->Existenciaskg'																									
                                                                    where idIngrediente ='$this->idIngrediente'";
																	mysqli_query($cone,$id);
																	echo $id;
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
															}

                     
                    
                    function eliminar(){
									try{   
									$c = new Conexion();
									$cone = $c->conectando();
									$sql= "delete from ingrediente where idIngrediente='$this->idIngrediente'";
									mysqli_query($cone,$sql);
								    echo $sql;
									echo '<script>	Swal.fire({
										position: "top",
										icon: "success",
										title: "El Ingrediente Fue Eliminado del Sistema",
										showConfirmButton: false,
										timer: 3000
									  });</script>';
									

									}catch(Exception $e){
									
																	
										echo'<script> Swal.fire({
											position: "top",
											icon: "warning",
											title: "El Ingrediente no se Puede Eliminar Porqué Tiene Datos Relacionados",
											showConfirmButton: false,
											timer: 3000
										  });</script>';
											
									}
									
								}
								
      }

	  
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>