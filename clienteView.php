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
	<section id="centro" class="container">
		<h3>Registro de cliente</h3>
		<form action="controlador_input.php" method="POST">
			<div class="form-group col-md-6">
				<div><label for="nombre">Nombre </label>*</div>
				<div><input type="text" name="nombre" id="nombre" class="form-control"></div>			
			</div>
			<div class="form-group col-md-6">
				<div><label for="apellido">Apellido </label>*</div>		    
				<div><input type="text" name="apellido" id="apellido" class="form-control"></div>
			</div>
			<div class="form-group col-md-6">
				<div><label for="correo">Correo</label>*</div>
				<div><input type="email" name="correo" id="correo" class="form-control"></div>
			</div>
			<div class="form-group col-md-6">
				<div><label for="telefono">Teléfono</label>*</div>
				<div><input type="tel" name="telefono" id="telefono" class="form-control"></div>
			</div>
			<div><p>* Campos obligatorios</p></div>
			<button type="submit" name="enviar" value="Enviar" class="btn btn-success">Registar</button>
		</form>	
	</section>	
</body>
</html>
