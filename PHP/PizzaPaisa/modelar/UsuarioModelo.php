<?php

    class Usuarios{

		

                    public $UsuarioDocumento;

				    public $UsuarioTelefono;

                    public $Contrasena;

                    public $Correo;

                    public $UsuarioPrimerNombre;

                    public $UsuarioApellido;

                    public $idTipoDocumento;
                     
                    public $idTipoUsuario;

					
                    function agregar(){
                                        $conet = new Conexion();
                                        $c = $conet->conectando();
                                        $query = "select * from usuario where UsuarioDocumento = '$this->UsuarioDocumento'";
                                        $ejecuta = mysqli_query($c, $query);
                                        if(mysqli_fetch_array($ejecuta)){
											echo '<script>	Swal.fire({
												position: "top",
												icon: "info",
												title: "El Registro ya Existe en el Sistema",
												showConfirmButton: false,
												timer: 3000
											  });';
                                        }else{
										   $Contrasena = password_hash( $this ->Contrasena, PASSWORD_DEFAULT);	
                                           $insertar = "insert into usuario values(
                                                                                    '$this->UsuarioDocumento',
																					'$this->UsuarioTelefono',
																					'$Contrasena',
																					'$this->Correo',
                                                                                    '$this->UsuarioPrimerNombre',
																					'$this->UsuarioApellido',                                                                                                                                                                                
                                                                                    '$this->idTipoDocumento',
                                                                                    '$this->idTipoUsuario'
                                           )";
                                           echo $insertar;
                                           mysqli_query($c,$insertar);
                                           echo '<script>	</script>';
                                            
                                        }

                    }

                    function modificar(){
                                    $c = new Conexion();
								    $cone = $c->conectando();
									$sql = "select * from usuario where UsuarioDocumento ='$this->UsuarioDocumento'";
									$r = mysqli_query($cone,$sql);
									if(!mysqli_fetch_array($r))
																{
																	echo "<script> alert('El Usuario ya Existe en el Sistema')</scrip>";
																}
																else
																	{
																	$id = "update usuario set 
																	UsuarioDocumento ='$this->UsuarioDocumento',
																	UsuarioTelefono = '$this->UsuarioTelefono',
																	Correo = '$this->Correo',
																	UsuarioPrimerNombre = '$this->UsuarioPrimerNombre',
																	UsuarioApellido = '$this->UsuarioApellido',
																	idTipoDocumento = '$this->idTipoDocumento',
																	idTipoUsuario = '$this->idTipoUsuario' where UsuarioDocumento ='$this->UsuarioDocumento'";
																	mysqli_query($cone,$id);
																	//echo $id;
																	echo '<script>	Swal.fire({
																		position: "top",
																		icon: "success",
																		title: "El Registro Fue Actualizado en el Sistema",
																		showConfirmButton: false,
																		timer: 3000
																	  });</script>';			
																	
																		
																}
				}

                     
                    
                    function eliminar(){
									try{   
									$c = new Conexion();
									$cone = $c->conectando();
									$sql= "delete from usuario where UsuarioDocumento='$this->UsuarioDocumento'";
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