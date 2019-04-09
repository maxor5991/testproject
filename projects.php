<?php
<<<<<<< HEAD
=======
	/*-------------------------
	Autor: GSN
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
>>>>>>> parent of c916fa0... Insercion de proyectos
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
<<<<<<< HEAD
	$active_proyecto="active";
=======
	$active_project="active";
>>>>>>> parent of c916fa0... Insercion de proyectos
	$title="Proyectos | Simple Invoice";
?>
		<?php include("head.php");?>
		
		<br>
<<<<<<< HEAD
	<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-danger" data-toggle="modal" data-target="#newProject">
				<span class="glyphicon glyphicon-plus" ></span>
				Nueva Categoría
				</button>
			</div>
			<h4>
			<i class='glyphicon glyphicon-search'></i>
			 Buscar Proyectos
			 </h4>
=======

	
    <div class="">
	<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo proyecto</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Proyecto</h4>
>>>>>>> parent of c916fa0... Insercion de proyectos
		</div>
		<div class="panel-body">
	<?php
			include("modal/new_project.php");
				include("modal/edit_project.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre del proyecto" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			
		
	
			
			
			
  </div>
</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/proyectos.js"></script>
  </body>
</html>
