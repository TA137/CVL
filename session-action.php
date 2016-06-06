<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection
?>

<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">Last action performed daily</div>
				</div>
  				<div class="panel-body">
				  <?php
									  $stmt = $DB_con->prepare("select user.user_Id id,user.Firstname firstname,user.username username,doc_sessions.time_in,doc_sessions.time_out,actions_doc.action_doc from user left join(doc_sessions join(actions_doc join upload_doc )) on user.user_Id=doc_sessions.user_Id and doc_sessions.sess_id=actions_doc.session_Id and upload_doc.id=actions_doc.upl_doc_id  where user.user_Id in (select user_Id from doc_sessions)");
									  $count_stmt = $DB_con->prepare("SELECT count(*) cat_num FROM user left join(doc_sessions join(actions_doc join upload_doc )) on user.user_Id=doc_sessions.user_Id and doc_sessions.sess_id=actions_doc.session_Id and upload_doc.id=actions_doc.upl_doc_id  where user.user_Id in (select user_Id from doc_sessions)");
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
			                  <th>Firstname</th>
			                  <th>username</th>
                              <th>Time in</th>
			                  <th>Time out</th>
                              <th></th>
			                </tr>
			              </thead>
			              <tbody>
			                				  <?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
																	  //add some setting like edit view card  and details
																	  echo "<tr>
																			<td>{$i}</td>
																			<td>{$row['firstname']}</td>
                                                                            <td>{$row['username']}</td>
                                                                            <td>{$row['time_in']}</td>
                                                                            <td>{$row['time_out']}</td>
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
		else{
			header('location:login.php');
		}
?>			