<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
	header("location: login.php");
	exit;
}
/*Llama a las conexiones */
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_productos="active";
	$title="Inventario | Simple Stock";
?>
<?php include("head.php");?>
<br>
<div class="">
<div class="panel panel-default">
		<div class="panel-heading">
			<div class="btn-group pull-right">
				<button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoProducto">
					<span class="glyphicon glyphicon-plus" ></span>
					Agregar
				</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Consultar tareas</h4>
		</div>
	<div class="panel-body">
	<?php
			include("modal/r_task.php");
			include("modal/e_task.php");
			?>
	<form class="form-horizontal" role="form" id="datos">
    <div class="row">
    <div class='col-md-4'>
    <label>Filtrar por código o nombre</label>
    <input type="text" class="form-control" id="task_query" placeholder="Código o nombre de la tarea" onkeyup='load(1);'>
    </div>
    <div class='col-md-4'>
   <label>Filtrar por categoría</label>
    <select class='form-control' name='id_categoria' id='id_categoria' onchange="load(1);">
    <option value="">Selecciona una categoría</option>-->
    <?php 
							$query_categoria=mysqli_query($con,"select * from categorias order by nombre_categoria");
							while($rw=mysqli_fetch_array($query_categoria))	{
								?>
							<option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option>			
								<?php
							}
							?>
						</select>
					</div>
					<div class='col-md-12 text-center'>
						<span id="loader"></span>
					</div>
				</div>
				<hr>
				<div class='row-fluid'>
					<div id="resultados"></div><!-- Carga los datos ajax -->
				</div>	
				<div class='row'>
					<div class='outer_div'></div><!-- Carga los datos ajax -->
				</div>
			</form>
	</div>
						</div>

<?php
include("footer.php");
?>
<script type="text/javascript" src="js/tasks.js"></script>
</body>
</html>
<script>
function eliminar (id)
{
	var q= $("#task_query").val();
	var id_categoria= $("#id_categoria").val();
	$.ajax(
		{
		type: "GET",
		url: "./ajax/s_tasks.php",
		data: "id="+id,"q":q+"task_query="+id_categoria,
		beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
				load(1);
				}
		});
}
				$(document).ready(function()
				{
					<?php 
					if (isset($_GET['delete'])){
						?>
						eliminar(<?php echo intval($_GET['delete'])?>);	
						<?php
						}
						?>
						});
						$( "#guardar_producto" ).submit(function( event ) 
						{
							$('#guardar_datos').attr("disabled", true);
							var parametros = $(this).serialize();
							$.ajax(
								{
									type: "POST",
									url: "./ajax/nuevo_producto.php",
									data: parametros,
									beforeSend: function(objeto)
									{
										$("#resultados_ajax_productos").html("Mensaje: Cargando...");
										},
										success: function(datos){
											$("#resultados_ajax_productos").html(datos);
											$('#guardar_datos').attr("disabled", false);
											load(1);
											}
											});
											event.preventDefault();
											})
											</script>