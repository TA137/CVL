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
									  $stmt = $DB_con->prepare("select * from user right join(doc_sessions left join (actions_doc join upload_doc on actions_doc.upl_doc_id=upload_doc.id) on doc_sessions.sess_id = actions_doc.session_Id) on user.user_Id=doc_sessions.user_Id where user.user_Id=:user_id");
                                      $count_stmt = $DB_con->prepare("SELECT count(*) cat_num FROM user right join(doc_sessions left join (actions_doc join upload_doc on actions_doc.upl_doc_id=upload_doc.id) on doc_sessions.sess_id = actions_doc.session_Id) on user.user_Id=doc_sessions.user_Id where user.user_Id=:user_id");
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
			                  <th>username</th>
                              
			                </tr>
			              </thead>
			              <tbody>
			                				  <?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                      echo "<tr>
																			<td>{$i}</td>
																			<td><a href='#'>{$row['username']}</a></td>
                                                                            <td>{$row['a']}</td>
																			<td>{$last_r['tim_done']}</td>
                                                                            <td>{$last_r['Doc_name']}</td>
																			<td>{$last_r['action_doc']}</td></tr>";
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