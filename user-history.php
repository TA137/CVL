<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection
if($_REQUEST['user_Id']){
    $id=$_REQUEST['user_Id'];
?>

<div class="content-box-large">
  				<div class="panel-heading">
					<?php
						$stmt_user = $DB_con->prepare("select * from user where user_Id=:user_id");
						$stmt_user->execute(array(':user_id'=>$id));
						$row_user=$stmt_user->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="panel-title"><h3>Action history performed by: <?php echo strtoupper(substr($row_user['Firstname'],0,1)).strtolower(substr($row_user['Firstname'],1,20))."\t".strtoupper(substr($row_user['Lastname'],0,1));  ?>.</h3></div>
				</div>
  				<div class="panel-body">
				  <?php
									  $stmt = $DB_con->prepare("select * from doc_sessions left join (actions_doc join (upload_doc join organization on upload_doc.org_id=organization.id) on actions_doc.upl_doc_id=upload_doc.id) on doc_sessions.sess_id = actions_doc.session_Id where doc_sessions.user_Id=:user_id order by time_in desc");
                                      $count_stmt = $DB_con->prepare("SELECT count(*) cat_num FROM doc_sessions left join (actions_doc join (upload_doc join organization on upload_doc.org_id=organization.id) on actions_doc.upl_doc_id=upload_doc.id) on doc_sessions.sess_id = actions_doc.session_Id where doc_sessions.user_Id=:user_id");
									  $stmt->execute(array(':user_id'=>$id));
									  $count_stmt->execute(array(':user_id'=>$id));
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
			                  <th>Last session Time in</th>
                              <th>Last session Time out</th>
                              <th>Done actions time</th>
							  <th>Organization</th>
                              <th>Files</th>
							  <th></th>
			                </tr>
			              </thead>
			              <tbody>
			                				  <?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
																	  //add some setting like edit view card  and details
                                                                      $name=substr($row['Doc_name'],0,30);
																	  echo "<tr>
																			<td>{$i}</td>
																			<td>{$row['time_in']}</td>
                                                                            <td>{$row['time_out']}</td>
																			<td>{$row['tim_done']}</td>
                                                                            <td>{$row['organization']}</td>
                                                                            <td>$name</td>
																			<td>{$row['action_doc']}</td></tr>";
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