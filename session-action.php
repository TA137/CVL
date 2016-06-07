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
									  $stmt = $DB_con->prepare("select max(sess_id) sess,user.user_Id id_user,user.username username,max(doc_sessions.time_in) a from user right join doc_sessions on user.user_Id=doc_sessions.user_Id where user.user_Id in(select user_Id from doc_sessions) group by user.user_Id order by a desc");
									  $count_stmt = $DB_con->prepare("SELECT count(*) cat_num FROM user right join doc_sessions on user.user_Id=doc_sessions.user_Id where user.user_Id in(select user_Id from doc_sessions) group by user.user_Id order by time_in");
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
                              <th>Last session Time in</th>
                              <th>Last Time done action</th>
							  <th>On file action</th>
							  <th></th>
			                </tr>
			              </thead>
			              <tbody>
			                				  <?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
																	  //add some setting like edit view card  and details
																$last_s = $DB_con->prepare("select * from actions_doc join upload_doc on actions_doc.upl_doc_id=upload_doc.id where actions_doc.session_Id=:session_id order by actions_doc.id desc limit 1");
																$last_s->execute(array(':session_id'=>$row['sess']));
																$last_r=$last_s->fetch(PDO::FETCH_ASSOC);
									  	  							$name=substr($last_r['Doc_name'],0,30);
																	  echo "<tr>
																			<td>{$i}</td>
																			<td><a href='#' onclick='user_history({$row['id_user']})'>{$row['username']}</a></td>
                                                                            <td>{$row['a']}</td>
																			<td>{$last_r['tim_done']}</td>
                                                                            <td>$name</td>
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