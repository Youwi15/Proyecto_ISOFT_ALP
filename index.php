<?php 
  require 'database.php';
  session_start();

 if (isset($_POST['login'])) {
   $user = $_POST['user'];
   $password = $_POST['password'];

   $query = $conn->prepare("SELECT * FROM usuarios WHERE USUARIO=:user");
   $query->bindParam("user", $user, PDO::PARAM_STR);
   $query->execute();

   $result = $query->fetch(PDO::FETCH_ASSOC);

   if (!$result) {
    echo '<script>alert("ERROR: Usuario o contraseña incorrecta")</script>';
   } else {
     if (password_verify($password, $result['contrasena'])) {
       $_SESSION['user_id'] = $result['id'];
       echo '<script>alert("¡Bienvenido! Ha iniciado sesión correctamente")</script>';
       header('location: main.php');
     } else {
      echo '<script>alert("ERROR: Usuario o contraseña incorrecta?")</script>';
     }
   }
 }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema del Banco de Germoplasma INIA LARA Inicio de Sesión</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>
<body>

    
    <section class="login">
        <img src="recursos/logo inia.png" alt="">
        <h1>Sistema del Banco de Germoplasma INIA LARA</h1>
        <div id="linea">.</div>
        <form action="" id="formLogin" method="post">

            <label for="" >Usuario</label>
            <input type="text" name="user" class="inputTexto"></input>

            <label for="" >Contraseña</label>
            <input type="password" name="password" class="inputTexto"> </input>

        <button type="submit" value="" name="login">Entrar</button>
        </form>
        <br><br><a href="signup.php">¿No tiene una Cuenta? Regístrese</a>
    </section> <!-- fin section login -->



</body>
</html>