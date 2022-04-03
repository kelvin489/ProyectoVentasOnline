<?php
session_start();
require_once('conexion.php');
 
if(isset($_POST['submit']))
{
	if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
 
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$sql = "select * from cliente where email = :email ";
			$handle = $pdo->prepare($sql);
			$params = ['email'=>$email];
			$handle->execute($params);
			if($handle->rowCount() > 0)
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $getRow['password']))
				{
					unset($getRow['password']);
					$_SESSION = $getRow;
					header('location:home-conect.php');
					exit();
				}
				else
				{
					$errors[] = " Correo y Contraseña incorrectos";
				}
			}
			else
			{
				$errors[] = "Correo o Contraseña incorrectos";
			}
			
		}
		else
		{
			$errors[] = "Correo no valido";	
		}
 
	}
	else
	{
		$errors[] = "Correo o Contraseña  son requeridos";	
	}
 
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Ventas Online</title>
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <section>
        <div class="caption">
            <h1> Vamos Conectate!</h1>
            <p>Los mejores precios a tu disposición &#10095;</p>
        </div>
        <div class="imgBx">
            <img src="img/login1.jpg">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2>Login</h2>
                <form method="POST" action="login.php">
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="text" name="email">
                    </div>
                    <div class="inputBx">
                        <span>Contraseña</span>
                        <input type="password" name="password">
                    </div>
                    <?php
                        if (isset($errors) && count($errors) > 0) {
                            foreach ($errors as $error_msg) {
                                echo '<div class="error" style="color: #fff;">' . $error_msg . ' <i class="fa-solid fa-circle-exclamation"></i></div>';
                            }
                        }
                    ?>
                    <div class="inputBx">
                        <input type="submit" name="submit" value="Ingresar">
                    </div>
                    <div class="inputBx">
                        <p>No tienes una cuenta? <a href="register.php">Registrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html>