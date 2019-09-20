<?php 
//implementar los métodos que retornen true o false;
//include('accesoDB');

class Basedatos {
    public $db;

function __construct() {  
  include_once('const.php');
  $this->db= $this->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
}

//metodos
public function conectar($pdb_host,$pdb_user,$pdb_pass,$pdb_name){

	$db= new mysqli($pdb_host,$pdb_user,$pdb_pass,$pdb_name);
    
	if($db->connect_error){
    	die("Error:".$db->connect_error);    
	}
   return $db;   
}
//codificar utf-8
function codificar($pvar){
  $codificado = trim($pvar);
	$codi_utf8 = utf8_encode($codificado);
  $codi_real_scape = real_scape_string($codi_utf8);    
	return  $codi_real_scape;
}

function descodificar($pvar){
	$descodificado = utf8_decode($pvar);
	return $descodificado;
} 
//function insertar cliente

function add_cliente($pnombre,$papellido,$pdireccion,$ptelefono){
    $expresion= $this->db->stmt_init(); 
    $query= "INSERT INTO clientes (nombre, apellido, correo, telefono) VALUES(?,?,?,?)";

    if(!$expresion->prepare($query)){
       	die("Error:".$expresion->error);

    }else{
       	$expresion->bind_param('sssi',$pnombre,$papellido,$pdireccion,$ptelefono);
       	$expresion->execute();       
    }
}

// generar tabla con listado 
 function generar_tabla($parray){
 	if(isset($parray)){
 		$cant=count($parray);
 		$tabla="<table border='1' cellpadding='3'><tr><th>Nombre</th><th>Apellido</th><th>Dirección</th><th>Teléfono</th><th>Entrada</th><th>Salida</th><th>Borrar</th><th>Editar</th></tr>"; 	
 		for ($i=0;$i<$cant;$i++){
 			$tabla.="<tr align='center'>"; 			
 			$tabla.="<td>".$parray[$i]['nombre']."</td>";
 			$tabla.="<td>".$parray[$i]['apellido']."</td>";
 			$tabla.="<td>".$parray[$i]['correo']."</td>";
 			$tabla.="<td>".$parray[$i]['telefono']."</td>";
 			$tabla.="<td>".$parray[$i]['entrada']."</td>";
 			$tabla.="<td>".$parray[$i]['salida']."</td>";
      if($parray[$i]['entrada']!=NULL){
        $tabla.="<td><a href=listado.php?borrar={$parray[$i]['id_reserva']}>Borrar<a></td>";
        $tabla.="<td><a href=listado.php?editar={$parray[$i]['id_reserva']}>Editar<a></td>";
      }else{
        $tabla.="<td></td>";
        $tabla.="<td></td>";
      }
 			$tabla.="</tr>\n";	
 		}
 		$tabla.="</table>"; 	
 		return $tabla;
 	} 	
 }
// devuelve un array con el resultado de la consulta si es un select
 function mostrar($pconsulta){
    $resultado=$this->db->query($pconsulta);
    $array_resultado=[];

    if($resultado->num_rows>0){
        while ($fila = $resultado->fetch_assoc()){
         $array_resultado[]=$fila;      
        } 
    }
    return $array_resultado;
}
//buscar 
function buscar($pcorreo){

    $expresion= $this->db->stmt_init();
    $consulta = "SELECT nombre, apellido, correo, telefono, salida, entrada FROM clientes LEFT JOIN reservas ON clientes.id_cliente = reservas.id_cliente  WHERE correo = ?";    
  
    if(!$expresion->prepare($consulta)){

      die("Error:".$expresion->error);    

    }
    else{

      $expresion->bind_param('s',$pcorreo);
      $expresion->execute();

      //  recoger lo que devuelve la consulta

      $array_resultado=[];
      $result= $expresion->get_result();

      //var_dump($result->num_rows);
      if($result->num_rows>0){
       if($result){
         while ($fila = $result->fetch_assoc()){
           $array_resultado[]=$fila;      
         }
       }
      // print_r($array_resultado);
      return $array_resultado; 
    } 
  }
}
// buscar dado un id y que devuelva los datos en un array
function buscar_cliente($pid_cliente){
	$consulta= "SELECT nombre,apellido,correo,telefono FROM clientes WHERE id_cliente=$pid_cliente";
	$resultado= $this->db->query($consulta);
	$fila=$resultado->fetch_assoc(); 
	if($resultado->num_rows>0){
		return $fila;
	}else{
		return false;
	}
}
//verificar fechas
function verificar_reserva($pentrada,$psalida){

  $consulta ="SELECT * FROM reservas where  (entrada > '{$pentrada}' AND salida < '{$psalida}') OR (entrada <= '{$pentrada}' and '{$pentrada}' < salida) OR ('{$psalida}' > entrada and '{$psalida}' <= salida ) "; 
  $resultado=$this->db->query($consulta);
  // echo $consulta;
  // echo $resultado->num_rows;
  if($resultado->num_rows>0){
    return false;
  }else{
    return true;
  }
}

function add_reserva($pid_cliente,$pentrada,$psalida){
  if($this->verificar_reserva($pentrada,$psalida)){

    $expresion= $this->db->stmt_init(); 
    $query= "INSERT INTO reservas (id_cliente, entrada, salida) VALUES(?,?,?)";

    if(!$expresion->prepare($query)){
        die("Error:".$expresion->error);
        return false;
    }else{
        $expresion->bind_param('iss',$pid_cliente,$pentrada,$psalida);
        $expresion->execute();
        return true;
   } 
  }else {
      echo "No hay disponibilidad";
  }  
}
function borrar_reserva($pid_reserva){
   $consulta= "DELETE FROM reservas where id_reserva={$pid_reserva}";
   $resultado=$this->db->query($consulta);
}
function get_reserva($pid_reserva){
   $consulta="SELECT * FROM reservas WHERE id_reserva={$pid_reserva}";
   $resultado=$this->db->query($consulta);
   $fila=$resultado->fetch_assoc();
   return $fila;
}

//function update reserva 

function update_reserva($pid_cliente,$pentrada,$psalida){ 

  $expresion= $this->db->stmt_init();
  $consulta = "UPDATE reservas SET entrada= ?, salida= ? WHERE id_reserva= ?";

  if(!$expresion->prepare($consulta)){
      die("Error:".$expresion->error);
      return false;
  }else{
      $expresion->bind_param('ssi',$pentrada,$psalida,$pid_cliente);
      $expresion->execute();
      return true;
   } 
   //validar que se pueda reservar una vez actualizado
}

function paginacion($ptamano_pagina,$ppagina){
  $consulta = " SELECT * FROM clientes LEFT JOIN reservas ON clientes.id_cliente=reservas.id_cliente LIMIT ".$ppagina * $ptamano_pagina.",".$ptamano_pagina;               
  $consulta2 = " SELECT COUNT(id_cliente) AS num FROM clientes";                   
               
  $resultado = $this->db->query($consulta2); // devuelve un objeto 
  $fila_registro = $resultado->fetch_assoc(); // fetch_assoc para obtener row en array asociativo.
  // generar valores 
  $array_tabla = $this->mostrar($consulta); 
  echo $this->generar_tabla($array_tabla);    
                
  //crear los enlaces               
  $anterior = $ppagina - 1; 
  $siguiente = $ppagina + 1;

  if($ppagina != 0){                     
      echo "<a href=listado.php?pagina={$anterior} class='enlace_paginacion'>Anterior</a>";
  }        

  if($ppagina < ($fila_registro['num']/$ptamano_pagina)-1){                         
      echo "<a href=listado.php?pagina={$siguiente}>Siguiente</a>";
  }   
}
}

// Clase Fichero 

class Fichero {

public $file_name;

public function __construct(){
      include('const.php'); 
      $this->file_name=FILE_NAME;
}

public function get_file_name(){
  return $this->file_name;
}

//buscar en un archivo donde se almacenan usuarios y contraseñas 
function buscar_usuario($puser, $ppassword, $pfichero){

  if($enlace = fopen($pfichero,"r")){
    $contenido = fread($enlace, filesize($pfichero));  
    //buscar
    $pos=strpos($contenido,$puser);  //buscar usuario en el contenido
    if($pos === false){
      return false;
    }
    else{
      $datos_usuarios=explode(',',$contenido);
      foreach ($datos_usuarios as $value) {
          $fila[]=explode('/',$value);          
          foreach ($fila as $clave => $value2) {
            if($clave==$puser){
              $hash_fichero=$value2;
              return true;
          } 
      }
    }
 }
  if(isset($hash_fichero)){
      if(password_verify($ppassword,$hash_fichero[1])){
        return true;
      }else{
        return false;
      }
  }   
  else{
    return false;
  }  
}
}

function verificar_acceso($pusuario, $ppassword){
  $file=$this->file_name;

  $usuario='admin'; //debe estar almacenado en otro fichero 
  if(strcmp($usuario,$pusuario)===0){
    // si el usuario coicide  luego procedo a verificar la contraseña 
    if($enlace = fopen($file,"r")){
      $contenido = fread($enlace, filesize($file));
      if(password_verify($ppassword,$contenido)){
        return true;
      }
    }
  }else{
    return false;
  }
}

function set_password($pusuario,$ppassword_old,$ppassword_new){

  $file=$this->file_name;  
  $usuario='admin';//debe estar almacenado en otro fichero
  $enlace = fopen($file, 'c+');
  $contenido=fread($enlace,filesize($file)); 

  rewind($enlace);
  if(strcmp($usuario, $pusuario)===0){

    if(password_verify($ppassword_old,$contenido)){

     $hash_nueva=password_hash($ppassword_new,PASSWORD_BCRYPT);
     fwrite($enlace,$hash_nueva);
     return true;

    }else{
      return false;
    }
 
 }else{
   return false;
 }
}
}
?>