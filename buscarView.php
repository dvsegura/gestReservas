<?php 
require('libreria.php'); 
session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
    header("location:login.php");
   }
}else{
    header("location:login.php");
}
$basedatos= new Basedatos();
//$db=$basedatos->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME); 
include('menu.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscar Cliente</title>
	 <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="centro" class="container">
	<h3>Buscar de Cliente</h3>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<div class="form-grup col-md-6">          
            <label for="busqueda">Introducir dirección de correo</label>
		    <input type="email" name="busqueda" id="busqueda" class="form-control">         
        </div>
        <div><button type="submit" name="buscar" value="Buscar" class="btn btn-success">Buscar</button> </div>
		    
	</form>
<?php 
    // búsqueda con sentencia preparada
    if(isset($_POST['buscar'])){
    if(!empty($_POST['busqueda'])){
        $correo=$_POST['busqueda'];
        $datos_usuario = $basedatos->buscar($correo);

        if(!empty($datos_usuario)){
            echo $basedatos->generar_tabla($datos_usuario);//usar otra funcion generar tabla 2
        }
        else{
            echo "<div class='alert alert-danger'>El usuario con esta dirección de correo electrónico no se encuentra.</div>";
        }                	
    }
    }   
 ?>
 </section>
</body>
</html>