<?php 

    class Conexion{

        private $servidor = "127.0.0.1";

        private $usuario = "root";
        
        private $password = "";

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