<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
   <div class="container">
       <div class="row">
           <div class="col-md-4">
               
           </div>
           
           <div class="col-md-4">
           <br><br><br>  
               <div class="card">
                   
                   <div class="card-header">
                       Login
                   </div>
                   <div class="card-body">
                       <form action="login2.php" method="POST">
                       <div class = "form-group">
                       <label >Usuario</label>
                       <input type="text" class="form-control" name="Nombre" placeholder="Escribe Usuario" required>
                       <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                       </div>
                       <div class="form-group">

                       <label>Contraseña</label>
                       <input type="password" class="form-control" name="Codproducto"  placeholder="Escribe contraseña" required>
                       </div>
                     
                       <button type="submit"  name="submit" class="btn btn-primary">Acceso Sistema</button>
                       </form>
                       
                       
                       
                   </div>
<?php
if($_POST){
    session_start();
    require("config/dbconfig.php");
    $nom=$_POST["Nombre"];
    $con=$_POST ["Codproducto"];
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query=$conexion->prepare("SELECT * FROM empleado where Nombre= :nom and Codproducto=:con");
    $query->bindPAram(":nom",$nom);
    $query->bindPAram(":con",$con);
    $query->execute();
    $Nombre=$query->fetch(PDO::FETCH_ASSOC);
    if($Nombre){
        $_SESSION['Nombre']=$Nombre["Nombre"];
        header("Location:inicio.php");

    }
    else{
        echo "<p>Usuario o password son invalidos</p>";
    }

}
?>

                  
               </div>
               
           </div>
           
       </div>
   </div>
  </body>
</html>