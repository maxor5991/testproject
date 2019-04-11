<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
		$active_usuarios="active";	
	$title="Proyectos | Simple Stock";
?>

	<?php include("head.php");?>
<br>

    <div class="">
		<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-danger" data-toggle="modal" data-target="#myModal">
				<span class="glyphicon glyphicon-plus" ></span> 
				Nuevo Proyecto
				</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar proyectos</h4>
		</div>			
			<div class="panel-body">
			<?php
			include("modal/new_project.php");
			include("modal/edit_project.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombres:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre" onkeyup='load(1);'>
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

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/projects.js"></script>

	
	


  </body>
</html>
<script>
$( "#save_project" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/new_project.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#save_data').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#edit_project" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/edit_project.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos3').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var name_project = $("#name_project"+id).val();
			var des_project = $("#des_project"+id).val();
			var user_id = $("#user_id"+id).val();
			var task_id = $("#task_id"+id).val();
			
			$("#mod_id").val(id);
			$("#name_project2").val(name_project);
			$("#des_project2").val(des_project);
			$("#user_id2").val(user_id);
			$("#task_id2").val(task_id);
			
		}
</script>