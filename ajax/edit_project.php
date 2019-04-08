<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) { 
           $errors[] = "Nombre vacío";
        }  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$mod_nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$mod_descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));	
		$id_project=intval($_POST['mod_id']);
		$sql="UPDATE projects SET name_project='".$mod_nombre."', des_proj='".$mod_descripcion."' WHERE id_project='".$id_project."'";
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