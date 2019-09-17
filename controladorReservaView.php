<?php
// include('menu.html');
session_start();
if(isset($_SESSION['acceso'])){
   if($_SESSION['acceso']!=1){
   	header("location:login.php");
   }
}else{
	header("location:login.php");
}
require('libreria.php');
require('const.php');
include('Client.php');


$basedatos= new Basedatos();
$db=$basedatos->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

if(isset($_POST['enviar_reserva'])){
	if(!empty($_POST['id_cliente']) && !empty($_POST['entrada']) && !empty($_POST['salida'])){
        // filtrar
		$id_cliente=$_POST['id_cliente'];
		$entrada=$_POST['entrada'];
		$salida=$_POST['salida'];  
		if($basedatos->verificar_reserva($entrada,$salida)){			
           $basedatos->add_reserva($id_cliente,$entrada,$salida);         
           header('location:listado.php');
		}
		else{

            if($cliente->disponibilidad($entrada,$salida)){
			   echo "<div>En nuestras instalaciones no tenemos disponibilidad para esta fecha. Si desea puede reservar en Can Sergi <a href='http://localhost/controladorReservaView.php?idg={$id_cliente}&entradag={$entrada}&salidag={$salida}'>Si</a></div>";
			   echo "<div><a href='reservaView.php'>Regresar</a></div>";			    
		    }else{
			   echo "Lo sentimos pero no tenemos habitaciones disponibles para estas fechas en nuestra red de casas rurales";
		    }		   	   	

		}
    }

 }else{
 	echo "<div class='error'>Todos los campos son obligatorios</div>";
 }


// validar que se hayan enviado los datos por GET

if(isset($_GET['idg']) && isset($_GET['entradag']) && isset($_GET['salidag'])){
	//guardarlos en variables
	$id= $_GET['idg'];
	$entrada=$_GET['entradag'];
	$salida=$_GET['salidag'];

	$datos=$basedatos->buscar_cliente($id);
	// guardar cada datos del array en variables por separado 
	$nombre=$datos['nombre'];
	$apellido=$datos['apellido'];
	$correo=$datos['correo'];
	$telefono=$datos['telefono'];
	
	//tratamiento de los retornos de los metodos 
	//$new_id=$cliente->insertarCliente($nombre,$apellido,$correo,$telefono); //oscar
	$new_id=$cliente->insertar_cliente($nombre,$apellido,$correo,$telefono); // sergi
	//var_dump($new_id);
	//if($cliente->insertarReserva($new_id,$entrada,$salida)){  //llamada a la funcion de oscar
	//if($cliente->insertarreserva($new_id,$entrada,$salida)){  // llamada a la funcion de sergi
	if($cliente->insertaReserva($new_id,$entrada,$salida)){  //mio
		//header('location:reservaView.php');
		echo "<div class='success'>La reserva se ha efectuado correctamente.</div>";

    }else{
    	echo "<div class='error'>Lo sentimos pero la reserva no se ha podido efectuar.</div>";
    }
} 

// actualizar reserva 

if(isset($_POST['actualizar_reserva'])){
	if(!empty($_POST['id_reserva']) && !empty($_POST['entrada']) && !empty($_POST['salida'])){
        
		$id_reserva=$basedatos->codificar($_POST['id_reserva']);
		$entrada=$basedatos->codificar($_POST['entrada']);
		$salida=$basedatos->codificar($_POST['salida']);
       // echo $basedatos->update_reserva($id_reserva,$entrada,$salida);
        if($basedatos->update_reserva($id_reserva,$entrada,$salida)){                    	
       		header('location:listado.php');
        }else{
        	echo "No se ha podido modificar la reserva";
        }
    }else{
    	echo "<div class='error'>Todos los campos son obligatorios</div>";
    }
}


?>