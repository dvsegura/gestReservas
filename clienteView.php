<?php
session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
   	header("location:login.php");
   }
}else{
	header("location:login.php");
}
include('menu.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<section id="centro">
		<h3>Registro de cliente</h3>
		<form action="controlador_input.php" method="POST">
			<div class="form-group">
			<div><label for="nombre">Nombre </label>*</div>
			<div><input type="text" name="nombre" id="nombre" placeholder="Entre Nombre"></div>
			</div>
			<div><label for="apellido">Apellido </label>*</div>
			<div><input type="text" name="apellido" id="apellido"></div>
			<div><label for="correo">Correo</label>*</div>
			<div><input type="email" name="correo" id="correo"></div>
			<div><label for="telefono">Teléfono</label>*</div>
			<div><input type="tel" name="telefono" id="telefono"></div>
			<div><input type="submit" name="enviar" value="Enviar"></div>
		</form>	
	</section>	
</body>
</html>
