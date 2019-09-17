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
$basedatos= new Basedatos();
$db=$basedatos->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

$id_reserva=$_GET['editar'];
$fila=$basedatos->get_reserva($id_reserva);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<section id="registro_reservas">
		<h3>Registro de reservas</h3>
		<form action="controladorReservaView.php" method="POST">
			<div><label for="id_reserva">ID </label>*</div>
			<div><input type="text" name="id_reserva" id="id_reserva" value="<?php echo $fila['id_reserva']?>"></div> <!-- guardar los valores en una variable que por defecto estara vacia ''  -->
			<div><label for="entrada">Fecha de entrada</label> *</div>
			<div><input type="date" name="entrada" id="entrada" value="<?php echo $fila['entrada']?>"></div>
            <div><label for="salida">Fecha de salida</label> *</div>
			<div><input type="date" name="salida" id="salida" value="<?php echo $fila['salida']?>"></div>
			<div><input type="submit" name="actualizar_reserva" value="Actualizar"></div>
		</form>	
	</section>
	
</body>
</html>