<?php
  include "dbconfig.php";
?>
<div class="content-box-large">
  				<div class="panel-body" >
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example">
						<thead>
			                <tr>
                                <th>#</th>
                                <th>Names</th>
                                <th>Username</th>
                                <th>print</th>
                                <th>upload</th>
                                <th>download</th>
                                <th>all</th>
			                </tr>
			              </thead>
			              <tbody>
			               <?php
									  $stmt = $DB_con->prepare("SELECT * FROM user");
									  $count_stmt = $DB_con->prepare("SELECT count(*) num_user FROM user");
									  $stmt->execute(array());
									  $count_stmt->execute(array());
									  $count_row=$count_stmt->fetch(PDO::FETCH_ASSOC);
								  if($count_row['num_user']==0){
										  echo "No user found";
									  }else{
                                        $i=0;
											   //<tr><th class='col-xs-1'>#</th><th class='col-xs-2'>Icon</th><th class='col-xs-3'>Upload Time</th><th class='col-xs-6'>Description</th></thead><tbody>";
                                                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $i++;
                                                    //add some setting like edit view card and details
                                                    echo "<tr>
                                                            <td>{$i}</td>
                                                            <td>{$row['Firstname']}</td>
                                                            <td>{$row['username']}</td>";
															?>
                                                            <td><input type='checkbox' onclick="change_details(<?php echo $row['user_Id']; ?>,'Print')"<?php if($row['Print']){ echo "checked";} ?> ></td>
                                                            <td><input type='checkbox' onclick="change_details(<?php echo $row['user_Id']; ?>,'Download')"<?php if($row['Download']){ echo "checked";} ?> ></td>
                                                            <td class='center'><input type='checkbox' onclick="change_details(<?php echo $row['user_Id']; ?>,'Upload')"<?php if($row['Upload']){ echo "checked";} ?> ></td>
                                                            <td class='center'><input type='checkbox'<?php if($row['Print'] && $row['Download'] && $row['Upload']){ echo "checked";} ?> ></td>
                                               <?php            
                                                 }    
										  }
								  
							?>
			            </tbody>
			         </table>
  				</div>
</div>		