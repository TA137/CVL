<?php
session_start(); //session is staring
  include "dbconfig.php";
  if(isset($_REQUEST['folder_id'])){
    $org_id=$_REQUEST['folder_id'];
?>

<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">inside folder</div>
				</div>
  				<div class="panel-body">
				  <?php
									  $stmt = $DB_con->prepare("SELECT *,upload_doc.id id_doc FROM upload_doc join organization join categories on organization.id=upload_doc.org_id and upload_doc.cat_id=categories.id where org_id=:org_id");
									  $count_stmt = $DB_con->prepare("SELECT count(*) apl_num FROM upload_doc join organization join categories on organization.id=upload_doc.org_id and upload_doc.cat_id=categories.id where org_id=:org_id");
									  $stmt->execute(array('org_id'=>$org_id));
									  $count_stmt->execute(array('org_id'=>$org_id));
									  $count_row=$count_stmt->fetch(PDO::FETCH_ASSOC);
								  if($count_row['apl_num']==0){
										  echo "No document found";
									  }else{?>
  					<div class="table-responsive">
  						<table class="table table-striped">
			              <thead>
			                <tr>
			                  <th></th>
								<th>Document Name</th>
								<th>Document Type</th>
								<th>Document Organization</th>
								<th>Uploaded Date</th>
								<th></th>
			                </tr>
			              </thead>
			              <tbody><?php
			               
											   //<tr><th class='col-xs-1'>#</th><th class='col-xs-2'>Icon</th><th class='col-xs-3'>Upload Time</th><th class='col-xs-6'>Description</th></thead><tbody>";
                                                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    //add some setting like edit view card  and details
                                                    echo "<tr>
                                                            <td><input type='checkbox'></td>
                                                            <td>{$row['Doc_name']}</td>
                                                            <td>{$row['Doc_type']}</td>
															<td>{$row['organization']}</td>
                                                            <td class='center'>{$row['upl_time']}</td>";
                                                      echo"<td class='center'>";if($_SESSION['Print'] || $_SESSION['userType']){ echo"<a class='print-down' href=''><img src='logo/print_icon.png'/></a>"; }
																	  if($_SESSION['Download'] || $_SESSION['userType']){ echo "<a class='print-down' href='#'><img src='logo/download_icon.png'/></a>"; }
																	  if($row['Doc_type']!='docx' && $row['Doc_type']!='xlsx'){ ?><a onclick="view_doc(<?php echo $row['id_doc'].",".$row['org_id'].",".$row['cat_id'].",";
																	  echo "'".$row['Doc_type']."'";echo")"?>" class='print-down' href='#'><img src='logo/view.png'/></a><?php }echo"</td></tr>";
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
?>
  			