<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection
  if(isset($_REQUEST['cat_id'])&&isset($_REQUEST['organization_id'])){
    $cat_id=$_REQUEST['cat_id'];
    $organization_id=$_REQUEST['organization_id'];
?>

<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">inside folder</div>
				</div>
  				<div class="panel-body">
				  <?php
                  if($user->check_subcategories($cat_id)=="no sub-directory"){
									  $stmt = $DB_con->prepare("SELECT *,upload_doc.id id_doc FROM upload_doc join organization join categories on organization.id=upload_doc.org_id and upload_doc.cat_id=categories.id where org_id=:org_id and cat_id=:cat_id");
									  $count_stmt = $DB_con->prepare("SELECT count(*) apl_num FROM upload_doc join organization join categories on organization.id=upload_doc.org_id and upload_doc.cat_id=categories.id where org_id=:org_id and cat_id=:cat_id");
									  $stmt->execute(array('org_id'=>$organization_id,':cat_id'=>$cat_id));
									  $count_stmt->execute(array('org_id'=>$organization_id,':cat_id'=>$cat_id));
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
													  <a  href="#" onclick="print_doc(<?php echo $row['id_doc'].",".$row['org_id'].",".$row['cat_id'].",";
													  echo "'".$row['Doc_type']."'";echo")"?>" title="Click here to print" data-reveal-id="print_form" data-animation="fade" name="wallah"><img src='logo/print_icon.png'/></a>
													  <?php }
													  
													  
													  if($_SESSION['Download'] || $_SESSION['userType']){ ?><a  href="#" onclick="download_doc(<?php echo"'download',".$row['id_doc'].",".$row['org_id'].",".$row['cat_id'].",";
													  echo "'".$row['Doc_type']."'";echo")"?>" title="Click here to download" data-reveal-id="download_form" data-animation="fade" name="wallah"><img src='logo/download_icon.png'/></a><?php }
													  
													  if($row['Doc_type']!='docx' && $row['Doc_type']!='xlsx'){ ?><a title="Click here to view" onclick="view_doc(<?php echo"'view',".$row['id_doc'].",".$row['org_id'].",".$row['cat_id'].",";
													  echo "'".$row['Doc_type']."'";echo")"?>" class='print-down' href='#'><img src='logo/view.png'/></a><?php }echo"</td></tr>";
												   }     
										  }
                  	  
							?>
			              </tbody>
			            </table>
                    </div>
            <?php
            }else{
                                      $stmt = $DB_con->prepare("SELECT * FROM sub_categories where cat_id=:cat_id");
									  $count_stmt = $DB_con->prepare("SELECT count(*) sub_cat_num FROM sub_categories where cat_id=:cat_id");
									  $stmt->execute(array(':cat_id'=>$cat_id));
									  $count_stmt->execute(array(':cat_id'=>$cat_id));
									  $count_row=$count_stmt->fetch(PDO::FETCH_ASSOC);
									  $i=1;
								  if($count_row['sub_cat_num']==0){
										  echo "No document found";
                                          echo $cat_id;
									  }else{
										?>
                                         <div class="table-responsive">
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
                                                                                <td>{$row['sub_directory']}</td>";
                                                                        echo"<td class='center'><a class='print-down' href='#' onclick='insideSubCategories({$row['sub_id']},$cat_id,$organization_id)'><i class='glyphicon glyphicon-folder-open'></i> Open</a></td></tr>";
                                                                          $i++;
                                                                     }      
                                    }
								  
							?>
			              </tbody>
			            </table>
  					</div>
                    <?php } ?>
  				</div>
  			</div>
<?php
  }
}
		else{
			header('location:login.php');
		}
?>			