<?php
require_once(__DIR__ . "/../conectar/conexion.php");
    class Reserva{

		

                    public $idPedido;

				    public $FechaHoraRealizacio;

                    public $Entregada;

                    public $FechaHoraEntrega;

                    public $PrecioTotal;

                    public $UsuarioDocumento;

                    public $UsuarioApellido;

                    

					
                    function agregar(){
                                        $conet = new Conexion();
                                        $c = $conet->conectando();
                                        $query = "select * from reserva where idPedido = '$this->idPedido'";
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
										   	
                                           $insertar = "insert into reserva values(                                                                              
																					'$this->idPedido',
                                                                                    '$this->FechaHoraRealizacio',
																					'$this->Entregada',                                                                                                                                                                                
                                                                                    '$this->FechaHoraEntrega',
                                                                                    '$this->PrecioTotal',
                                                                                    '$this->UsuarioDocumento'
                                           )";
                                           echo $insertar;
                                           mysqli_query($c,$insertar);
                                           echo '<script>Swal.fire({
																	position: "top",
																	icon: "success",
																	title: "El Registro Fue Agregado en el Sistema",
																	showConfirmButton: false,
																	timer: 3000
																	});</script>';
                                            
                                        }

                    }
					public function modificarr() {
						$conet = new Conexion();
						$c = $conet->conectando();
					
						$query = "UPDATE reserva SET Entregada = ? WHERE idPedido = ?";
						$stmt = mysqli_prepare($c, $query);
					
						if (!$stmt) {
							echo json_encode(["status" => "error", "message" => "Error preparando la consulta: " . mysqli_error($c)]);
							exit;
						}
					
						mysqli_stmt_bind_param($stmt, "ii", $this->Entregada, $this->idPedido);
						$resultado = mysqli_stmt_execute($stmt);
					
						if (!$resultado) {
							echo json_encode(["status" => "error", "message" => "Error ejecutando la consulta: " . mysqli_stmt_error($stmt)]);
							exit;
						}
					
						mysqli_stmt_close($stmt);
					
						// Devolver respuesta JSON en vez de HTML
						header('Content-Type: application/json'); // Indica que la respuesta es JSON
						ob_clean();
						echo json_encode(["status" => "success", "message" => "El Registro Fue Actualizado en el Sistema"]);
						exit;
					}

                    function modificar(){
                                    $c = new Conexion();
								    $cone = $c->conectando();
									$sql = "select * from reserva where idPedido ='$this->idPedido'";
									$r = mysqli_query($cone,$sql);
									if(!mysqli_fetch_array($r))
																{
																	echo "<script> alert('La reserva ya Existe en el Sistema')</scrip>";
																}
																else
																	{
																	$id = "update reserva set 
																	idPedido ='$this->idPedido',
																	FechaHoraRealizacio = '$this->FechaHoraRealizacio',
																	Entregada = '$this->Entregada',
																	FechaHoraEntrega= '$this->FechaHoraEntrega',
																	PrecioTotal = '$this->PrecioTotal',
                                                                    UsuarioDocumento ='$this->UsuarioDocumento'									
                                                                    where idPedido ='$this->idPedido'";
																	mysqli_query($cone,$id);
																	echo $id;
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
									$sql= "delete from reserva where idPedido='$this->idPedido'";
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