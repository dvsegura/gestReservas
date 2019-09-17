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
    <link rel="stylesheet" href="style.css">
</head>
<body>

  
	<div id="contenido">
		<div id="izquierda"></div>
		<div id="centro">
      <h3>Listado de usuarios</h3>
			<?php 
          $basedatos->paginacion($tamano_pagina,$pagina);                                             
			?>
		</div>
		<div id="derecha"></div>
	</div>	
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