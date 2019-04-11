<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include('is_logged.php');
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id_project'])){
		$id_project=intval($_GET['id_project']);
		$query=mysqli_query($con, "select * from projects where id_project='".$id_project."'");
		$rw_proj=mysqli_fetch_array($query);
		$count=$rw_proj['id_project'];
		if ($id_project!=1){
			if ($delete1=mysqli_query($con,"DELETE FROM projects WHERE id_project='".$id_project."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede borrar el usuario administrador. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('firstname', 'lastname');//Columnas de busqueda
		 $sTable = "projects";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id_project desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './projects.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>ID</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Usuarios</th>
					<th>Fecha Creación</th>
					<th>Fecha Final</th>
					<th>Tareas</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_project=$row['id_project'];
					$name_project=$row['name_project'];
					$des_project=$row['des_project'];
					$user_id=$row['user_id'];
					$task_id=$row['task_id'];
					$date_added= date('d/m/Y', strtotime($row['date_added']));
					$date_end= date('d/m/Y', strtotime($row['date_end']));
						
					?>
					
					<input type="hidden" value="<?php echo $row['name_project'];?>" id="nombres<?php echo $id_project;?>">
					<input type="hidden" value="<?php echo $row['des_project'];?>" id="descripcion<?php echo $id_project;?>">
					<input type="hidden" value="<?php echo $user_id;?>" id="usuario<?php echo $id_project;?>">
					<input type="hidden" value="<?php echo $task_id;?>" id="tareas<?php echo $id_project;?>">
				
					<tr>
						<td><?php echo $id_project; ?></td>
						<td><?php echo $name_project; ?></td>
						<td ><?php echo $des_project; ?></td>
						<td ><?php echo $user_id; ?></td>
						<td><?php echo $date_added;?></td>
						<td><?php echo $date_end;?></td>
						<td><?php echo $task_id;?></td>
						
					<td >
					<span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar proyecto' onclick="obtener_datos('<?php echo $id_project;?>');" data-toggle="modal" data-target="#myModal2">
					<i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar proyecto' onclick="eliminar('<? echo $id_project; ?>')">
					<i class="glyphicon glyphicon-trash"></i></a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>