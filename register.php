<?php
session_start();
require_once('conexion.php');
 
if(isset($_POST['submit']))
{
    if(isset($_POST['nombre'],$_POST['email'],$_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        $firstName = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hashPassword = $password;
        $options = array("cost"=>4);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
        $date = date('Y-m-d H:i:s');
 
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $sql = 'select * from cliente where email = :email';
            $stmt = $pdo->prepare($sql);
            $p = ['email'=>$email];
            $stmt->execute($p);
            
            if($stmt->rowCount() == 0)
            {
                $sql = "insert into cliente (nombre, email, `password`, created_at,updated_at) values(:vnombre,:email,:pass,:created_at,:updated_at)";
            
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':vnombre'=>$firstName,
                        ':email'=>$email,
                        ':pass'=>$hashPassword,
                        ':created_at'=>$date,
                        ':updated_at'=>$date
                    ];
                    
                    $handle->execute($params);
                    
                    $success = 'Usuario creado correctamente!!';
                    
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
            }
            else
            {
                $valFirstName = $firstName;
                $valEmail = '';
                $valPassword = $password;
 
                $errors[] = 'El correo  ya esta registrado';
            }
        }
        else
        {
            $errors[] = "El correo no es valido";
        }
    }
    else
    {
        if(!isset($_POST['nombre']) || empty($_POST['nombre'])
        && ($_POST['email']) || empty($_POST['email']) && ($_POST['password']) || empty($_POST['password']))
        {
            $errors[] = 'Completa los campos porfavor';
        }
        else
        {
            $valFirstName = $_POST['nombre'];
            $valEmail = $_POST['email'];
            $valPassword = $_POST['password'];
        }
 
        
    }
 
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Ventas Online</title>
    <link rel="stylesheet" type="text/css" href="css/registerstyle.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <section>
    <div class="caption">
            <h1> Registrate Ahora!</h1>
            <p>&#10094; Es rápido y sencillo</p>
        </div>
        <div class="imgBx">
            <img src="img/login4.jpg">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2>Sign Up</h2>
                <?php 
                                        if(isset($errors) && count($errors) > 0)
                                        {
                                            foreach($errors as $error_msg)
                                            {
                                                echo '<div class="error">'.$error_msg.' <i class="fa-solid fa-circle-exclamation"></i></div>';
                                            }
                                        }
                                        
                                        if(isset($success))
                                        {
                                            
                                            echo '<div class="success">'.$success.' <i class="fa-solid fa-circle-check"></i></div>';
                                        }
                                    ?>
                <form method="POST" action="register.php">
                    <div class="inputBx">
                        <span>Nombre</span>
                        <input type="text" name="nombre">
                    </div>
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="text" name="email">
                    </div>
                    <div class="inputBx">
                        <span>Contraseña</span>
                        <input type="password" name="password">
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="submit" value="Ingresar">
                    </div>
                    <div class="inputBx">
                        <p>Tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html>