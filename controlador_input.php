<?php 
require('libreria.php');
require('const.php');

$basedatos= new Basedatos();
$db=$basedatos->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

include('Client.php');
/*
separar todo el codigo de las reservas en otro controlador
//incluirlo en un fichero aparte
$opciones['location'] = "http://localhost/Server.php"; cambiarlo por otro servidor
$opciones['uri'] = "http://localhost/Server.php";
$cliente = new SoapClient(NULL,$opciones);

*/

//recogida y tratamiento de datos clientes

if(isset($_POST['enviar'])){
	if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['telefono'])){
		$nombre=$basedatos->codificar($_POST['nombre']);
		$apellido=$basedatos->codificar($_POST['apellido']);
		//pendiente validar correo *****
		$correo=$_POST['correo'];
		$telefono=$_POST['telefono'];
        $basedatos->add_cliente($nombre,$apellido,$correo,$telefono);

	}else{
		echo "<div class='error'>Todos los campos son obligatorios</div>";
	}
}


?>