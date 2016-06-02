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
                                                    $name=substr($row['Doc_name'],0,30);
													echo "<tr>
															<td><input type='checkbox'></td>
															<td>$name</td>
															<td>{$row['organization']}</td>
															<td>{$row['categories']}</td>
															<td>{$row['upl_time']}</td>";
                                                     echo"<td class='center'>";if($_SESSION['Print'] || $_SESSION['userType']){ ?>
																	  
													<a onclick="view_doc(<?php echo"'view',".$row['id_doc'].",".$row['org_id'].",".$row['cat_id'].",";
													echo "'".$row['Doc_type']."'";echo")"?>" class='print-down' href='#'>
													<img src='logo/print_icon.png'/></a>
													<?php }
													
													
													if($_SESSION['Download'] || $_SESSION['userType']){ ?><a href="view_doc.php?doc_id=<?php echo $row['id_doc']."&org_id=".$row['org_id']."&cat_id=".$row['cat_id']."&Doc_type=";
													echo $row['Doc_type']."&Action=download";?>" class='print-down'>
													<img src='logo/download_icon.png'/></a><?php }
													
													if($row['Doc_type']!='docx' && $row['Doc_type']!='xlsx'){ ?><a onclick="view_doc(<?php echo"'view',".$row['id_doc'].",".$row['org_id'].",".$row['cat_id'].",";
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
}
		else{
			header('location:login.php');
		}
?>			