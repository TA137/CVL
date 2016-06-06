<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection
  if(isset($_REQUEST['folder_id'])){
    $org_id=$_REQUEST['folder_id'];
?>

<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">inside folder</div>
				</div>
  				<div class="panel-body">
				  <?php
									  $stmt = $DB_con->prepare("SELECT * FROM categories");
									  $count_stmt = $DB_con->prepare("SELECT count(*) cat_num FROM categories");
									  $stmt->execute(array());
									  $count_stmt->execute(array());
									  $count_row=$count_stmt->fetch(PDO::FETCH_ASSOC);
									  $i=1;
								  if($count_row['cat_num']==0){
										  echo "No document found";
									  }else{
										?>
											  
						<table class="table table-striped">
			              <thead>
			                <tr>
			                  <th>#</th>
			                  <th>Organization</th>
			                  <th></th>
			                </tr>
			              </thead>
			              <tbody>
			                				  <?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
																	  //add some setting like edit view card  and details
																	  echo "<tr>
																			  <td>{$i}</td>
																			  <td>{$row['categories']}</td>";
																	  echo"<td class='center'><a class='print-down' href='#' onclick='insideCategories({$row['id']},$org_id)'><i class='glyphicon glyphicon-folder-open'></i> Open</a></td></tr>";
                                                                        $i++;
                                                                   }      
										  }
								  
							?>
			              </tbody>
			            </table>
  					</div>
  				</div>
  			</div>
<?php
  }
}
		else{
			header('location:login.php');
		}
?>			