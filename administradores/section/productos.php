<?php include('../template/cabecera.php');?>

<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtCodproducto=(isset($_POST['txtCodproducto']))?$_POST['txtCodproducto']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


include("../config/dbconfig.php");

switch($accion){
    case "Agregar":
        //INSERT INTO `producto` (`Idproducto`, `Idpedido`, `Codproducto`, `Nomproducto`, `Precioproducto`, `Estadoproducto`, `Nombcategoria`, `imagen`) VALUES ('1', '1', '111', 'Juan', '122', 'Bueno', 'electrodomesticos', 'img.jpg');
        $sentenciaSQL=$conexion->prepare("INSERT INTO producto (Nombre, Imagen,Codproducto,Categoria,Precio) VALUES (:Nombre, :Imagen, :Codproducto, :Categoria, :Precio);");
        $sentenciaSQL->bindParam(':Nombre',$txtNombre);
        $sentenciaSQL->bindParam(':Codproducto',$txtCodproducto);
        $sentenciaSQL->bindParam(':Categoria',$txtCategoria);
        $sentenciaSQL->bindParam(':Precio',$txtPrecio);
        $fecha= new Datetime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        if($tmpImagen!=""){
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo) ;
        }

        $sentenciaSQL->bindParam(':Imagen',$nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:productos.php");
        break;


    case "Modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET Nombre=:Nombre, Codproducto=:Codproducto, Categoria=:Categoria, Precio=:Precio WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Nombre',$txtNombre);
        $sentenciaSQL->bindParam(':Codproducto',$txtCodproducto);
        $sentenciaSQL->bindParam(':Categoria',$txtCategoria);
        $sentenciaSQL->bindParam(':Precio',$txtPrecio);
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();

        


        //echo "presionado boton Modificar";
        if($txtImagen!=""){
            $fecha= new Datetime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo) ;

            $sentenciaSQL=$conexion->prepare("SELECT Imagen FROM producto WHERE Id=:Id");
            $sentenciaSQL->bindParam(':Id',$txtID);
            $sentenciaSQL->execute();
            $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if( isset($lista["Imagen"]) &&($lista["Imagen"]!="imagen.jpg") ){
    
                if(file_exists("../../img/".$lista["Imagen"])){
    
                    unlink("../../img/".$lista["Imagen"]);
                }
    
            }

             
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET Imagen=:Imagen WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        }
        header("Location:productos.php");
        break;
    case "Cancelar":
        header("Location:productos.php");
         break;
    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre=$lista['Nombre'];
        $txtImagen=$lista['Imagen'];
        $txtCodproducto=$lista['Codproducto'];
        $txtCategoria=$lista['Categoria'];
        $txtPrecio=$lista['Precio'];
        //echo "presionado boton Seleccionar";
         break;
    case "Borrar":
        $sentenciaSQL=$conexion->prepare("SELECT Imagen FROM producto WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if( isset($lista["Imagen"]) &&($lista["Imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$lista["Imagen"])){

                unlink("../../img/".$lista["Imagen"]);
            }

        }
       
        $sentenciaSQL=$conexion->prepare("DELETE FROM producto WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id',$txtID);
        $sentenciaSQL->execute();
        header("Location:productos.php");
         break;
}
$sentenciaSQL=$conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
$listaProducto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
           Datos Productos
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
                <div class = "form-group">
                    <label for="txtCategoria">Categoria</label>
                    <input type="text" required class="form-control" value="<?php echo $txtCategoria; ?> " name="txtCategoria" id="txtCategoria" placeholder="Categoria">
                </div>
                <div class = "form-group">
                    <label for="txtPrecio">Precio</label>
                    <input type="text" required class="form-control" value="<?php echo $txtPrecio; ?> " name="txtPrecio" id="txtPrecio" placeholder="Precio">
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
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Codproducto</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProducto as $producto) { ?>
            <tr>
                <td ><?php echo $producto['Id'] ?></td>
                <td><?php echo $producto['Nombre']?></td>
                <td>
                <img class="img-thumbnail rounded" src="../../img/<?php echo $producto['Imagen']?>" width="100" alt="">    
                </td>
                <td><?php echo $producto['Codproducto']?></td>
                <td><?php echo $producto['Categoria']?></td>
                <td><?php echo $producto['Precio']?></td>
                <td>
                    <form method="post" >
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['Id']; ?>"/>
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