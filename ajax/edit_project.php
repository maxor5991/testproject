<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['edit_project'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if (
			!empty($_POST['edit_project']) &&
			!empty($_POST['mod_nombre'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$name_project=mysqli_real_escape_string($con,(strip_tags($_POST["name_project"],ENT_QUOTES)));
			$des_project=mysqli_real_escape_string($con,(strip_tags($_POST["des_project"],ENT_QUOTES)));
			$user_id=mysqli_real_escape_string($con,(strip_tags($_POST["user_id"],ENT_QUOTES)));
			$task_id=mysqli_real_escape_string($con,(strip_tags($_POST["task_id"],ENT_QUOTES)));
		
		
		$id_categoria=intval($_POST['edit_project']);
		$sql="UPDATE projects SET name_project='".$name_project."', des_project='".$des_project."', user_id='".$user_id."' , task_id='".$task_id."' WHERE id_project='".$id_project."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Categoría ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>