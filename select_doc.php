<!DOCTYPE html>

<html>
<head>
    <title>Page Title</title>
<link rel="stylesheet" href="css/bootstrap/bootstrap.css">

<!-- jQuery library -->
<script src="js/jquery/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="css/bootstrap/bootstrap.js"></script>
</head>
<body>
<?php
include "dbconfig.php";
        $stmt = $DB_con->prepare("SELECT * FROM upload_doc");
	$count_stmt = $DB_con->prepare("SELECT count(*) total_num FROM upload_doc");
        $stmt->execute(array());
	$count_stmt->execute(array());
	$count_row=$count_stmt->fetch(PDO::FETCH_ASSOC);
	
if($count_row['total_num']==0){
	    echo "No document found";
	}else{
            echo "<div class='container-fluid' style='z-index: -100;'>
            <div class='row' style='margin: 5% 0;'>
                <div class='panel panel-default'>
                  <div class='panel-heading'>
                    <h4>
                      Fixed Header Scrolling Table 
                    </h4>
                  </div>
                  <table class='table table-fixed table-striped'><thead>
                                  <tr><th class='col-xs-1'>#</th><th class='col-xs-2'>Icon</th><th class='col-xs-3'>Upload Time</th><th class='col-xs-6'>Description</th></thead><tbody>";
                                 while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                                    //add some setting like edit view card  and details
                                    echo "<tr>
                                            <td class='col-xs-1'>{$row['id']}</td>
                                            <td class='col-xs-2'>--</td>
                                            <td class='col-xs-3'>{$row['upl_time']}</td>";
                                    echo"<td class='col-xs-6'>{$row['description']}</td>";
                                 }
              echo "</tbody></table></div>
            </div>
          </div>";       
        }

?>
</body>
</html>