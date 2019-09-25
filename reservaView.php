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
		<h3>Registro de reservas</h3>
		<form action="controladorReservaView.php" method="POST">
			<div class="form-group col-md-6">
				<div><label for="id_cliente">ID </label> *</div>
				<div><input type="text" name="id_cliente" id="id_cliente" class="form-control"></div> <!-- generar un select con los id de clietes que hay  -->
				<small>ID es el identificar del usuario</small>
			</div>	
			<div class="form-group col-md-6">
				<div><label for="entrada">Fecha de entrada</label> *</div>
				<div><input type="date" name="entrada" id="entrada" class="form-control"></div>
		    </div>
            <div class="form-group col-md-6">
            	<div><label for="salida">Fecha de salida</label> *</div>
				<div><input type="date" name="salida" id="salida"class="form-control"></div>
			</div>	
			<small>* Todos los campos son obligatorios</small>
			<div><button type="submit" name="enviar_reserva" value="Reservar" class="btn btn-success">Reservar</button></div>
		</form>	
	</section>	
</body>
</html>
