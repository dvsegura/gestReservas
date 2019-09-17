<?php 
include('compartir.php');

$opciones['uri'] = "http://100.100.100.7/Server.php"; //mi servidor 
$servidor= new SoapServer(NULL,$opciones);
$servidor->setClass('Reserva');
$servidor->handle();

?>