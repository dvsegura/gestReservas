<?php 
session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
   	header("location:login.php");
   }
}else{
	header("location:login.php");
}
require('libreria.php');
include('menu.html');

//include('accesoDB.php');
// $basedatos= new Basedatos();
// $db=$basedatos->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

$fichero= new Fichero();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
    <section id="centro" class="container">
    <div class="rox"><h3>Cambiar contraseña</h3></div>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group col-md-6">
            <label>Contraseña actual</label>
            <input type="password" name="vieja" value="" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label>Nueva Contraseña</label>
            <input type="password" name="nueva" value="" class="form-control">
        </div>
        <button type="submit" name="cambiar" value="Cambiar contraseña">Cambiar</button>
    </form>	
    <?php
    if(isset($_POST['cambiar'])){
    if(isset($_POST['vieja']) && isset($_POST['nueva'])){
        $vieja=$_POST['vieja'];
        $nueva=$_POST['nueva']; 
        //$file_name='password.txt';
        $usuario=$_SESSION['usuario'];

        if($fichero->set_password($usuario,$vieja,$nueva)){
            echo "<div class='success'>La contraseña se ha cambiado exitosamente</div>";   
        }else{
            echo "<div class='error'>No se ha podido cambiar la contraseña.</div>";
        }
    }    
}
?> 
</section>
</body>
</html>
      

