<?php
include('menu.html');
session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
   	header("location:login.php");
   }
}else{
	header("location:login.php");
}
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
		<h3>Registro de reservas</h3>
		<form action="controladorReservaView.php" method="POST">
			<div><label for="id_cliente">ID </label>*</div>
			<div><input type="text" name="id_cliente" id="id_cliente"></div> <!-- generar un select con los id de clietes que hay  -->
			<div><label for="entrada">Fecha de entrada</label> *</div>
			<div><input type="date" name="entrada" id="entrada"></div>
            <div><label for="salida">Fecha de salida</label> *</div>
			<div><input type="date" name="salida" id="salida" ></div>
			<div><input type="submit" name="enviar_reserva" value="Reservar"></div>
		</form>	
	</section>	
</body>
</html>
