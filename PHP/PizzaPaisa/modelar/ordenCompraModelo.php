<?php

    class ordendecompra{

		public $idOrden;
        public $FechaPedido;
        public $UsuarioDocumento;

         function agregar(){
            $conet = new Conexion();
            $c = $conet->conectando();
            $query = "select * from ordendecompra where idOrden = '$this->idOrden'";
            $ejecuta = mysqli_query($c, $query);
            if(mysqli_fetch_array($ejecuta)){echo '<script>	Swal.fire({position: "top", icon: "info", title: "La orden ya se encuentra en el Sistema", showConfirmButton: false, timer: 3000});';
                }else{$insertar = "insert into ordendecompra values('$this->idOrden', '$this->FechaPedido','$this->UsuarioDocumento')";
                    echo $insertar; mysqli_query($c,$insertar); echo '<script> Swal.fire({position: "top", icon: "success", title: "La orden fue agregada al sistema", showConfirmButton: false, timer: 3000});</script>';}
                }

        function modificar(){$c = new Conexion();
            $cone = $c->conectando();
			$sql = "select * from ordendecompra where idOrden ='$this->idOrden'";
			$r = mysqli_query($cone,$sql);
			if(!mysqli_fetch_array($r)){echo "<script> alert('La orden ya se encuentra en el Sistema')</scrip>";}
				else{$id = "update ordendecompra set idOrden ='$this->idOrden',FechaPedido = '$this->FechaPedido', UsuarioDocumento = '$this->UsuarioDocumento' where idOrden ='$this->idOrden'";
					mysqli_query($cone,$id); echo $id; echo '<script> Swal.fire({ position: "top", icon: "success", title: "La orden se actualizo con éxito en el Sistema", showConfirmButton: false, timer: 10000});
                    </script>';}
				}

                     
                    
        function eliminar(){try{$c = new Conexion(); $cone = $c->conectando();
            $sql= "delete from ordendecompra where idOrden='$this->idOrden'";
				mysqli_query($cone,$sql); echo $sql; 
                echo '<script>	Swal.fire({position: "top", icon: "success", title: "La orden se elimino del Sistema", showConfirmButton: false, timer: 3000});</script>';
					}catch(Exception $e)
                    {echo'<script> Swal.fire({position: "top", icon: "warning", title: "No se pudo eliminar la orden del sistema", showConfirmButton: false, timer: 3000});</script>';}
					}
								
      }

	  
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>