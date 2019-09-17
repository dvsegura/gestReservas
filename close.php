<?php 
//cerrar seccion y enviar a la pagina del login 
session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
   	header("location:login.php");
   }
}else{
	header("location:login.php");
}
session_unset();
session_destroy();
header('location:login.php');
?>