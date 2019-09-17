
<?php 
require('libreria.php');
$fichero= new Fichero();
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="container">
    <section id="login">
	<h3>Panel de Acceso</h3>
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" autocomplete="off">
		<div><input type="text" name="usuario" placeholder="Usuario"></div>
	    <div><input type="password" name="password" placeholder="Contraseña"></div>
	    <div><input type="submit" name="login" value="Iniciar sección"></div>
	</form>
    </section>
	<?php 
		if(isset($_POST['login'])){
        	if(!empty($_POST['usuario']) && !empty($_POST['password'])){
        		$usuario = $_POST['usuario'];
        		$password = $_POST['password']; 
        		$file_name = "password.txt";
                var_dump($fichero->verificar_acceso($usuario, $password));
                if($fichero->verificar_acceso($usuario, $password)){ //metodo cambiado 
                    $_SESSION['acceso']=1; 
                    $_SESSION['usuario']=$usuario;
                    header('Location: listado.php');   //dar acceso                             	
                }
                else{
                	echo "<div class='error'>No se ha podido iniciar sesión</div>";
                }
        	}   
		}
    ?>
   </div> 
</body>
</html>