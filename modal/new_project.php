<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo proyecto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="save_project" name="save_project">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="name_project" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="name_project" name="name_project" placeholder="Nombre Proyecto" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="des_project" class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="des_project" name="des_project" placeholder="Descripción" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_id" class="col-sm-3 control-label">Usuarios</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Usuarios" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="task_id" class="col-sm-3 control-label">Tareas</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="task_id" name="task_id" placeholder="Tareas" required>
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>