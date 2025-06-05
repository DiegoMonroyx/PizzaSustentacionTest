<?php
    class proveedor{
        public $idProveedor;
        public $NombreProveedor;
        public $NumeroTelefono;
        public $direccion;
        public $Barrio;

        function agregar(){
        $conet = new Conexion();
        $c = $conet->conectando();
        $query = "select * from proveedor where idProveedor = '$this->idProveedor'";
        $ejecuta = mysqli_query($c, $query);
        if(mysqli_fetch_array($ejecuta)){
			echo '<script>	Swal.fire({position: "top", icon: "info", title: "El Registro ya Existe en el Sistema", showConfirmButton: false, timer: 3000});';
        }else{ 	$insertar = "insert into proveedor values(
                '$this->idProveedor',
				'$this->NombreProveedor',
                '$this->NumeroTelefono',
                '$this->direccion',
				'$this->Barrio')";
                echo $insertar;
                mysqli_query($c,$insertar);
                echo '<script>	</script>';}
        }

        function modificar(){
            $c = new Conexion();
			$cone = $c->conectando();
			$sql = "select * from proveedor where idProveedor ='$this->idProveedor'";
			$r = mysqli_query($cone,$sql);
			if(!mysqli_fetch_array($r)){echo "<script> alert('El proveedor ya existe en el sistema')</scrip>";
            }else{$id = "update proveedor set idProveedor ='$this->idProveedor',
				NombreProveedor = '$this->NombreProveedor',
				NumeroTelefono = '$this->NumeroTelefono',
				direccion = '$this->direccion',
                Barrio = '$this->Barrio',
			    idProveedor = '$this->idProveedor' where idProveedor ='$this->idProveedor'";
				mysqli_query($cone,$id);echo '<script>	Swal.fire({position: "top", icon: "success", title: "El Registro fue Actualizado en el Sistema", showConfirmButton: false, timer: 3000});</script>';}
			}

                     
        function eliminar(){
            try{$c = new Conexion();
			$cone = $c->conectando();
			$sql= "delete from proveedor where idProveedor='$this->idProveedor'";
		    mysqli_query($cone,$sql);
			echo $sql;
			echo '<script>	Swal.fire({position: "top",icon: "success", title: "El Registro Fue Eliminado del Sistema", showConfirmButton: false, timer: 3000});</script>';
			}catch(Exception $e){echo'<script> Swal.fire({position: "top", icon: "warning", title: "El Registro no se Puede Eliminar Porqué Tiene Datos Relacionados", showConfirmButton: false, timer: 3000});</script>';}
			}
    }

	  
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>