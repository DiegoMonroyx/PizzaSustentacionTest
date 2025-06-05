<?php
include("../conectar/conexion.php");
session_start();

if (isset($_POST['Ingresar'])) {
    $Correo = $_POST['Correo'];
    $Contrasena = $_POST['Contrasena'];
    
    // Store as session variable
    $_SESSION['Correo'] = $Correo;

    $c = new Conexion();
    $cone = $c->conectando();

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $cone->prepare("SELECT Contrasena FROM usuario WHERE Correo = ?");
    $stmt->bind_param("s", $Correo); // "s" specifies the variable type => 'string'

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the hashed password from the database
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Contrasena'];
        echo "Hashed password from DB: " . $hashedPassword;
        // Verify the given password against the hash in the database
        if (password_verify($Contrasena, $hashedPassword)) {
            header ("location: /PizzaPaisa/Vista/VistaUsuario/landing.php");
            exit();
        } else {
            $consulta="SELECT * from usuario WHERE Correo='$Correo' and Contrasena='$Contrasena' ";



        //SELECT a.nombreUsuario, a.claveUsuario, b.nombreNivel FROM usuarios a, niveles b WHERE  a.codigoNivel=b.codigoNivel
        
        $rs=mysqli_query($cone,$consulta);
        
        
        $filas=mysqli_num_rows($rs);//si los datos coinciden sera 1 (true) o 0 (false)
        
        if($filas > 0){
            
           header("Location: /PizzaPaisa/Vista/VistaUsuario/landing.php");
           
        }else{
           echo'<script type="text/javascript">
            alert("Usuario y clave no existen");
            window.location.href="inciarSesion.php";
            </script>';
            
        }
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    mysqli_free_result($result);
    // mysqli_close($cone); // Consider closing the connection as needed
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="../Config/css/bootstrap.min.css">
    <script href="../Config/js/bootstrap.min.js"></script>
</head>
<body>
    <main>
    <section class="container-md bg-white  d-flex align-items-center justify-content-center" id="formulario" >
        <div class=" mb-3"> 
            <h2>Inicio de Sesion</h2>
        </div>
        <form method="post" action=""  id="formularioInico">
            <div class="mb-4">
              <label for="exampleInputEmail1" class="form-label">Correo</label>
              <input type="email" name="Correo" id ="Correo" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp">
              
            </div>
            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label">Contraseña</label>
              <input type="password" name="Contrasena" class="form-control" id="Contrasena">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="Ingresar" class="btn btn-primary ms-y">Aceptar</button>
          </form>
      </section>
  </main>
    
  </body>
</html>