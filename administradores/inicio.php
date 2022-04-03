
<?php include('template/cabecera.php');?>
              
<?php 
    session_start();
  
    if(!$_SESSION['Nombre']){
      header('location:login2.php');
    }
?>        

              <div class="col-md-12">
              <div class="jumbotron">
                  <h1 class="display-3">Bienvenido <?php echo ucfirst($_SESSION['Nombre']); ?> :) !!</h1>
                  <p class="lead">Administrador</p>
                  <hr class="my-2">
                  <p>More info</p>
                  <p class="lead">
                      <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Empezar &#10095;</a>
                    </p>
                </div>
                  
              </div>
<?php include('template/pie.php');?>
              
