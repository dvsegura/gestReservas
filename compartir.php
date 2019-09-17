<?php 

class Reserva {
    private $db;

    public function __construct()
    {
        include('const.php');
        $this->db= $this->conectar(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    }
    public function conectar($pdb_host,$pdb_user,$pdb_pass,$pdb_name){

	$db= new mysqli($pdb_host,$pdb_user,$pdb_pass,$pdb_name);
    
	if($db->connect_error){
    	die("Error:".$db->connect_error);    
	}
   return $db;   
}
    // retorna el id del cliente o false
    public function get_id_cliente($pcorreo){

        $expresion= $this->db->stmt_init();
        $consulta = "SELECT id_cliente FROM clientes WHERE correo = ?";
        if(!$expresion->prepare($consulta)){
	        die("Error:".$expresion->error);    
    	}    	
        else{
        	$expresion->bind_param('s',$pcorreo);
        	$expresion->execute();

            $resultado= $expresion->get_result();

            if($resultado->num_rows!=0){
            	$id=$resultado->fetch_assoc();
            	return $id['id_cliente'];
            }
            else{
            	return false;
            }        	
        }
    }

    // metodo que devuelve true o false si el id existe
    public function existe_id($pid){
    	$expresion= $this->db->stmt_init(); 
        $query= "Select id_cliente from clientes where id_cliente=?";
        if(!$expresion->prepare($query)){
       		die("Error:".$expresion->error);
            return false;
    	}else{
       		$expresion->bind_param('i',$pid);
       		$expresion->execute();

       		if($expresion->get_result()!=NULL){
       			return true;  	
       		}
    	}
    }
    //inserta un cliente en una base de datos externa
    public function insertarCliente($pnombre,$papellido,$pcorreo,$ptelefono){
      //falta valida si ya el usuario esta
    	$expresion= $this->db->stmt_init(); 
      $query= "INSERT INTO clientes (nombre, apellido, correo, telefono) VALUES(?,?,?,?)";
        if(!$expresion->prepare($query)){
       		die("Error:".$expresion->error);
            return false;
    	}else{
       		$expresion->bind_param('sssi',$pnombre,$papellido,$pcorreo,$ptelefono);
       		$expresion->execute();
            //verificar filas afectadas
            if($expresion->affected_rows==1){
			        $id=$this->get_id_cliente($pcorreo);
              return $id;
            }
       		return false;
    	}
    }
    // si hay disponibilidad de fechas para la reserva
    public function disponibilidad($pentrada,$psalida){

    	$consulta ="SELECT * FROM reservas where  (entrada > '{$pentrada}' AND salida < '{$psalida}') OR (entrada <= '{$pentrada}' and '{$pentrada}' < salida) OR ('{$psalida}' > entrada and '{$psalida}' <= salida ) "; 
  		$resultado=$this->db->query($consulta);
  		if($resultado->num_rows>0){
    		return false;
  		}else{
    		return true;
 		}
    }
    // retorna true o false si ha podido hacer la reserva
    public function insertarReserva($pid,$pentrada,$psalida){
    if($this->existe_id($pid)){
    if($this->disponibilidad($pentrada,$psalida)){
  		$expresion= $this->db->stmt_init(); 
        $query= "INSERT INTO reservas (id_cliente, entrada, salida) VALUES(?,?,?)";
    	if(!$expresion->prepare($query)){
        	die("Error:".$expresion->error);
       		return false;
    	}else{
       		$expresion->bind_param('iss',$pid,$pentrada,$psalida);
        	$expresion->execute();
          //validar 
       		return true;
  		} 
  	}else {
  		return false;
    }        
    }else{
		return false;
    }
}

}

?>