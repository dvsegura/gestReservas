
<?php 
require('libreria.php');
$fichero= new Fichero();
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                      <a class="navbar-brand" href="#"></a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">                   
                          <li class="nav-item active">
                            <a class="nav-link" href="index.html">Inicio<span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Rutas</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="login.php">Reservas</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                          </li>
                        </ul>
                      </div>
            </nav>
            </header>           
            <section class="container-fluid border-bottom">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="http://lorempixel.com/output/nature-q-c-1200-300-8.jpg" class="d-block w-100" alt="...">                  
                        </div>
                        <div class="carousel-item">
                          <img src="http://lorempixel.com/output/nature-q-c-1200-300-3.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="http://lorempixel.com/output/nature-q-c-1200-300-4.jpg" class="d-block w-100" alt="...">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                </div>
            </section>   
    <div class="container">
   <!--  <h1 class="mt-5">Acceso limitado</h1>  -->       
   <!--  <section id="login"> -->
    <section class="main-row">
	<h1 class="mt-4">Panel de Acceso</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" autocomplete="off">
		<div class="form-group col-md-6">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" placeholder="Escriba el usuario" id="usuario" class="form-control">
        </div>
	    <div class="form-group col-md-6">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" placeholder="Escriba la contraseña " id="password" class="form-control">
        </div>
	    <div class="form-group"><input type="submit" name="login" value="Iniciar sección" class="btn btn-primary"></div>
	</form>
    </section>
	<?php 
		if(isset($_POST['login'])){
        	if(!empty($_POST['usuario']) && !empty($_POST['password'])){
        		$usuario = $_POST['usuario'];
        		$password = $_POST['password']; 
        		$file_name = "password.txt";
                //var_dump($fichero->verificar_acceso($usuario, $password));
                if($fichero->verificar_acceso($usuario, $password)){ //metodo cambiado 
                    $_SESSION['acceso']=1; 
                    $_SESSION['usuario']=$usuario;
                    // header('Location:listado.php');   //dar acceso 
                    echo '<script type="text/javascript"> window.location.assign("listado.php");</script>';                         	
                }
                else{
                    echo "<div class='alert alert-danger'>No se ha podido iniciar sesión</div>";
                }
        	}   
		}
    ?>
    </div>  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>     
</body>
</html>