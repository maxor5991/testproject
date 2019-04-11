<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar proyecto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="edit_project" name="edit_project">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="name_project2" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="name_project2" name="name_project2" placeholder="Nombre Proyecto" required>
					<input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="des_project2" class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="des_project2" name="des_project2" placeholder="Descripción" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_id2" class="col-sm-3 control-label">Usuarios</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_id2" name="user_id2" placeholder="Usuarios" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="task_id2" class="col-sm-3 control-label">Tareas</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="task_id2" name="task_id2" placeholder="Tareas" required>
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