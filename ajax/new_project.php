<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name_project'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['name_project'])){
		/* Connect To Database*/
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
			$name_project=mysqli_real_escape_string($con,(strip_tags($_POST["name_project"],ENT_QUOTES)));
			$des_project=mysqli_real_escape_string($con,(strip_tags($_POST["des_project"],ENT_QUOTES)));
			$user_id=mysqli_real_escape_string($con,(strip_tags($_POST["user_id"],ENT_QUOTES)));
			$task_id=mysqli_real_escape_string($con,(strip_tags($_POST["task_id"],ENT_QUOTES)));
			$date_added=date("Y-m-d H:i:s");
			$date_end=date("Y-m-d H:i:s");
			$sql="INSERT INTO projects (name_project, des_project, user_id, task_id, date_added, date_end) VALUES ('$name_project','$des_project','$user_id','$task_id','$date_added','$date_end')";
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "Categoría ha sido ingresada satisfactoriamente.";
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