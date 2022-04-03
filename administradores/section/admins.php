<?php include('../template/cabecera.php');?>

<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtCodproducto=(isset($_POST['txtCodproducto']))?$_POST['txtCodproducto']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


include("../config/dbconfig.php");

switch($accion){
    case "Agregar":
        //INSERT INTO `producto` (`Idproducto`, `Idpedido`, `Codproducto`, `Nomproducto`, `Precioproducto`, `Estadoproducto`, `Nombcategoria`, `imagen`) VALUES ('1', '1', '111', 'Juan', '122', 'Bueno', 'electrodomesticos', 'img.jpg');
        $sentenciaSQL=$conexion->prepare("INSERT INTO empleado (Nombre, Imagen,Codproducto) VALUES (:Nombre, :Imagen, :Codproducto);");
        $sentenciaSQL->bindParam(':Nombre',$txtNombre);
        $sentenciaSQL->bindParam(':Codproducto',$txtCodproducto);
        $fecha= new Datetime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        if($tmpImagen!=""){
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo) ;
        }

        $sentenciaSQL->bindParam(':Imagen',$nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:admins.php");
        break;


    case "Modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE empleado SET Nombre=:Nombre, Codproducto=:Codproducto WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Nombre',$txtNombre);
        $sentenciaSQL->bindParam(':Codproducto',$txtCodproducto);

        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();

        


        //echo "presionado boton Modificar";
        if($txtImagen!=""){
            $fecha= new Datetime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo) ;

            $sentenciaSQL=$conexion->prepare("SELECT Imagen FROM empleado WHERE Id=:Id");
            $sentenciaSQL->bindParam(':Id',$txtID);
            $sentenciaSQL->execute();
            $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if( isset($lista["Imagen"]) &&($lista["Imagen"]!="imagen.jpg") ){
    
                if(file_exists("../../img/".$lista["Imagen"])){
    
                    unlink("../../img/".$lista["Imagen"]);
                }
    
            }

             
        $sentenciaSQL=$conexion->prepare("UPDATE empleado SET Imagen=:Imagen WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        }
        header("Location:admins.php");
        break;
    case "Cancelar":
        header("Location:admins.php");
         break;
    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM empleado WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre=$lista['Nombre'];
        $txtImagen=$lista['Imagen'];
        $txtCodproducto=$lista['Codproducto'];
        //echo "presionado boton Seleccionar";
         break;
    case "Borrar":
        $sentenciaSQL=$conexion->prepare("SELECT Imagen FROM empleado WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if( isset($lista["Imagen"]) &&($lista["Imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$lista["Imagen"])){

                unlink("../../img/".$lista["Imagen"]);
            }

        }
       
        $sentenciaSQL=$conexion->prepare("DELETE FROM empleado WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        header("Location:productos.php");
         break;
}
$sentenciaSQL=$conexion->prepare("SELECT * FROM empleado");
$sentenciaSQL->execute();
$listaProducto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
           Datos Empleados
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" >
                <div class = "form-group">
                    <label for="txtID">ID</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?> " name="txtID" id="txtID" placeholder="ID">
                </div>
                <div class = "form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?> " name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>
                
                <div class = "form-group">
                    <label for="txtImagen">Imagen</label>
                    <br>
                    <?php if($txtImagen!=""){  ?>
                        <img class="img-thumbnail rounded"  src="../../img/<?php echo $txtImagen?>" width="100" alt="">  
                    <?php } ?>
                    <input type="file" class="form-control"  name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>
                <div class = "form-group">
                    <label for="txtCodproducto">Codproducto</label>
                    <input type="text" required class="form-control" value="<?php echo $txtCodproducto; ?> " name="txtCodproducto" id="txtCodproducto" placeholder="Codproducto">
                </div>
                
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div> 

</div>
<div class="col-md-7">
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Imagen</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProducto as $empleado) { ?>
            <tr>
                <td ><?php echo $empleado['Id'] ?></td>
                <td><?php echo $empleado['Nombre']?></td>
                <td>
                <img class="img-thumbnail rounded" src="../../img/<?php echo $empleado['Imagen']?>" width="100" alt="">    
                </td>
                <td><?php echo $empleado['Codproducto']?></td>
                <td>
                    <form method="post" >
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $empleado['Id']; ?>"/>
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                    </form>

                </td>
            </tr>
            <?php } ?>
         
        </tbody>
    </table>
</div>

<?php include("../template/pie.php"); ?>