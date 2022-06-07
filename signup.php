<?php 
   require 'database.php';
   session_start();

   if (isset($_POST['register'])) {
     $user = $_POST['user'];
     $password = $_POST['password'];
     $confpassword = $_POST['confpassword'];
     $password_hash = password_hash($password, PASSWORD_BCRYPT);
   if ($confpassword == $password) { 

     $query = $conn->prepare("SELECT * FROM usuarios WHERE USUARIO=:user");
     $query->bindParam("user", $user, PDO::PARAM_STR);
     $query->execute();

     if ($query->rowCount() > 0) {
       echo '<script>alert("El usuario ya está registrado")</script>';
     }

     if ($query->rowCount() == 0) {
       $query = $conn->prepare("INSERT INTO usuarios(USUARIO,CONTRASENA) VALUES (:user,:password_hash)");
       $query->bindParam("user", $user, PDO::PARAM_STR);
       $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
       $result = $query->execute();

       if ($result) {
        echo '<script>alert("Registro completado exitosamente")</script>';
       } else {
        echo '<script>alert("Algo salió mal")</script>';
       }
     } 
    } else {
      echo '<script>alert("La contraseña no pudo ser verificada, por favor, asegúrese que la ingresó correctamente.")</script>';
    }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Sistema del Banco de Germoplasma INIA LARA Registro de Usuario</title>
</head>
<body>
<section class="login">
        <img src="recursos/logo inia.png" alt="">
        <h1>Sistema del Banco de Germoplasma INIA LARA</h1>
        <div id="linea">.</div>
        <form action="signup.php" id="formLogin" method="post">
            <h2>Registro de Usuario</h2><br>
            <label for="" >Usuario</label>
            <input type="text" name="user" class="inputTexto"></input>

            <label for="" >Contraseña</label>
            <input type="password" name="password" class="inputTexto"> </input>

            <label for="" >Confirmar contraseña</label>
            <input type="password" name="confpassword" class="inputTexto"> </input>

        <button type="submit" value="" name="register">Registrar</button>
        </form>
        <br><br><a href="index.php">Volver</a>
    </section> <!-- fin section login -->
</body>
</html>