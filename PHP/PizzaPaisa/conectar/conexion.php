<?php 

    class Conexion{

        private $servidor = "pizzapaisa-db";

        private $usuario = "root";
        
        private $password = "123456";

        private $db = "pizzapaisa";

        public function conectando(){

                                    $con = mysqli_connect($this->servidor, $this ->usuario, $this-> password, $this->db)
                                    or die("Error al comunicar con el servidor");
                                    return $con;

                                    }

    }

    $obj = new Conexion();
    if($obj->conectando()){
          //echo "conectado";
        }
 

?>