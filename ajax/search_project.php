<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if (isset($_GET['id'])){
	$id_project=intval($_GET['id']);
	$query=mysqli_query($con, "select * from tasks where id_project='".$id_project."'");
	$count=mysqli_num_rows($query);
	if ($count==0){
		if ($delete1=mysqli_query($con,"DELETE FROM projects WHERE id_project='".$id_project."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
			}
			else 
			{
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
			  <strong>Error!</strong> No se pudo eliminar éste proyecto. Existen tareas vinculadas a ésta proyecto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('name_project');//Columnas de busqueda
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
		$sWhere.=" order by name_project";
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
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Agregado</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_project=$row['id_project'];
						$name_project=$row['name_project'];
						$descripcion_project=$row['des_proj'];
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					<tr>
						
						<td><?php echo $name_project; ?></td>
						<td ><?php echo $descripcion_project; ?></td>
						<td><?php echo $date_added;?></td>
						
					<td class='text-right'>
						<a href="#" class='btn btn-default' title='Editar categoría' data-name='<?php echo $name_project;?>' data-descripcion='<?php echo $descripcion_project?>' data-id='<?php echo $id_project;?>' data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar categoría' onclick="eliminar('<?php echo $id_project; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
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