<?php 
require('libreria.php');
include('menu.html');
//require('const.php');

$basedatos= new Basedatos();
//$db=$basedatos->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
    header("location:login.php");
   }
}else{
    header("location:login.php");
}
//conprobar que se ha iniciado seccion
//paginacion
$tamano_pagina=4;
$pagina=0;

if(isset($_GET['pagina'])){
	$pagina=$_GET['pagina'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de clientes</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
      <link rel="stylesheet" href="style.css">      
</head>
<body>  
<!-- 	<div id="contenido"> -->
  <div class="container">
		<!-- <div id="izquierda"></div> -->
    <div class="main-row">
		<!-- <div id="centro"> -->
      <h3>Listado de usuarios</h3>
			<?php 
          $basedatos->paginacion($tamano_pagina,$pagina);                                             
			?>
		</div>
		<!-- <div id="derecha"></div> -->
	</div>
  <!-- bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    	
</body>
</html>
<?php 
    if(isset($_GET['borrar'])){
       $id_reserva=$_GET['borrar']; 
       $basedatos->borrar_reserva($id_reserva);
    }
    if(isset($_GET['editar'])){
       header("location:gestionarReservaView.php?editar={$_GET['editar']}");
    }

?>