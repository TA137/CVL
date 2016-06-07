<?php
  session_start(); //session is staring
  if(!isset($_SESSION['username'])){
    header("location:login.php");
  }
  include "dbconfig.php";
  $user=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>scan documents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
	<link href="css/ui/jquery-ui.css" rel="stylesheet" media="screen">
    <link href="css/styles.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
<link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
<!-- Attach our CSS -->
	  	<link rel="stylesheet" href="popup/reveal.css">	
	  	
		<script type="text/javascript" src="popup/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="popup/jquery.reveal.js"></script>
		
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onclose="ConfirmClose()">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <img src="logo/Toplogo.png"/>
	              </div>
	           </div>
	        </div>
	     </div>
		 
	</div>
	<div class="navbar navbar-default navbar-back navbar-static-top" id="profile-header" role="navigation">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" id="navbar-brand" rel="home" href="#">
			 <?php
										  $stmt = $DB_con->prepare("SELECT * FROM user where username=:user");
										  $stmt->execute(array(':user'=>$user));
										  $row=$stmt->fetch(PDO::FETCH_ASSOC);
											  //add some setting like edit view card  and details
											  echo "<img src='"; if($row['Picture']=="profile/"){ echo "profile/default.png";}else{ echo $row['Picture']; } echo"'/>";
									  
								?> <?php echo $row['Firstname']."\t".strtoupper(substr($row['Lastname'],0,1));  ?></a>
		</div>
	
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<div class="col-sm-3 col-md-3 pull-right">
			<form class="navbar-form" role="search">
			<div class="inner-addon right-addon">
				<i class="glyphicon glyphicon-search"></i>
				<input type="text" placeholder="Search" class="form-control" />
			</div>
			</form>
			</div>
	
		</div>
	</div>
	<div  class="container-fluid dash-body">
		<div class="row">
			<div  class="col-md-3 left-menu">
			  <!--Start of side bar-->
			  <div class="sidebar content-box" style="display: block;">
				<?php if($_SESSION['Upload'] || $_SESSION['userType']){
				?>
						  <div class="top-nav">
								<div class="navbar-header">
									<ul class="nav navbar-nav">
									  <?php if($_SESSION['Upload'] || $_SESSION['userType']){
									  ?>
										  <li>
										  <!--start of button --->
											<button class="btn btn-default menu-button" onclick="upload(<?php echo $row['user_Id']; ?>)">Upload</button>
										  <!-- end of button -->
										  </li>
									  <?php
											}
									  ?>
									  <?php if($_SESSION['userType']){
									  ?>
										  <li>
										  <!-- start of drop down button -->
										  <div class="btn-group col-md-6">
												<button type="button" class="btn btn-default menu-button" onclick="createUsers()">
												  Create
												</button>
												
										   </div>
										  
										  <!--end of drop down button-->
										  </li>
									  <?php 
											}
									  ?>
									</ul>
							  </div>
						</div>
				<?php
				}
				?>
			  <div class="bottom-nav">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="#" onclick="all_files()"><i class="glyphicon glyphicon-file"></i> All files</a></li>
					<li><a href="#folders" id="folders"onclick="selectFolders();"><i class="glyphicon glyphicon-folder-close"></i>Folders</a></li>
					<?php if($_SESSION['userType']){
							  ?>
					<li><a href="#action_sessions" id="action_sessions"onclick="session_action();"><i class="glyphicon glyphicon-tasks"></i>Sessions&Actions</a></li>
					<?php } ?>
					<li class="submenu">
                         <a href="#settings" id="settings">
                            <span class="caret pull-right"></span>
							 <i class="glyphicon glyphicon-cog"></i>Settings
                         </a>
                         <!-- Sub menu -->
                         <ul>
							<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                            <li><a href="#" onclick="changePass();"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                            <?php
									  $stmt = $DB_con->prepare("SELECT * from user where username=:user");
									  $stmt->execute(array('user'=>$user));
											   //<tr><th class='col-xs-1'>#</th><th class='col-xs-2'>Icon</th><th class='col-xs-3'>Upload Time</th><th class='col-xs-6'>Description</th></thead><tbody>";
											while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
											   //add some setting like edit view card  and details
											   echo"<li><a href='#changeProf' id='changeProf' onclick='changeProfile({$row['user_Id']})'><i class='glyphicon glyphicon-user'></i> Change Profile</a></li>";
											}
								  
							if($_SESSION['userType']){
							  ?>
							<li><a href="#" onclick="changePrivilages()"><i class="glyphicon glyphicon-cog"></i> Change privilages</a></li>
							<?php
							}
							?>
                        </ul>
                    </li>
					<?php if($_SESSION['userType']){
					?>
						<li class="submenu">
							 <a href="#">
								<span class="caret pull-right"></span>
								 <i class="glyphicon glyphicon-user"></i>with
							 </a>
							 <!-- Sub menu -->
							 <ul>
							  <?php
										  $stmt = $DB_con->prepare("SELECT * FROM user where user_Id in (select user_Id from upload_doc)");
										  $stmt->execute(array());
										  $i=0;
										  while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
											  //add some setting like edit view card  and details
											  echo "<li><a href='#' onclick='changeProfile({$row['user_Id']})'><img src='"; if($row['Picture']=="profile/"){ echo "profile/default.png";}else{ echo $row['Picture']; } echo"'> {$row['username']}</td></a></li>";
										   }
									  
								?>
							</ul>
						</li>
					<?php
						}
					?>
                </ul>
			  </div>
				
				<!--end of side bar-->
             </div>
		
			</div>
			<div class="col-md-9 right-body" id="right-body">
			  
			  <div class="content-box-large">
  				<div class="panel-body" >
				  <?php
						$stmt = $DB_con->prepare("SELECT *,upload_doc.id id_doc FROM upload_doc join organization join categories on organization.id=upload_doc.org_id and upload_doc.cat_id=categories.id");
						$count_stmt = $DB_con->prepare("SELECT count(*) total_num FROM upload_doc join organization join categories on organization.id=upload_doc.org_id and upload_doc.cat_id=categories.id");
						$stmt->execute(array());
						$count_stmt->execute(array());
						$count_row=$count_stmt->fetch(PDO::FETCH_ASSOC);
						
					if($count_row['total_num']==0){
							echo "No document found";
					}else{
				  ?>
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th></th>
								<th>Document Name</th>
								<th>Document Organization</th>
								<th>Document categories</th>
								<th>Uploaded Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
											   				<?php   while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
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
  			</div>
			</div>
		</div>
	</div>

<div class="footer">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <img src="logo/logo.png"/>
	              </div>
	           </div>
	        </div>
	     </div>
		 
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
	
	<script src="js/jquery/jquery-ui.js"></script>
    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>

    <!--<script src="js/custom.js"></script>-->
    <script src="js/tables.js"></script>
	<script src="js/ajax_scripts.js"></script>
	<script src="js/jquery.js"></script>
	<!-- Attach necessary scripts -->
	<script>
	   $(document).ready(function() {
		  $('li').click(function() {
			$(".current").removeClass("current");
			$(this).addClass("current");
		  });
		});
	   $(window).scroll(function () {
			//console log determines when nav is fixed
			//console.log($(window).scrollTop())
			if ($(window).scrollTop() > 120) {
				//$("#profile-header").css("width", "100%");
				$('#profile-header').addClass('navbar-fixed-top');
			}
			if ($(window).scrollTop() < 121) {
				$('#profile-header').removeClass('navbar-fixed-top');
				
			}
		});
	   $(document).ready(function() {
    $('#example').DataTable();
} );

	  function focussing(id){
			  $("#"+id).css("border","1px solid #88D5E9");
	  }
	</script>
	<div id="print_form" class="reveal-modal" style="z-index:1000;">
			<form method="POST" class='print-down'action="print-files.php" target="_blank" style="width: 24px;" id="print_form<?php echo $row['id_doc']; ?>">
					 <input id="id_doc" type="text" name="id_doc" class="print-field">
					<input id="org_id" type="text" name="org_id"class="print-field">
					<input id="cat_id" type="text" name="cat_id" class="print-field">
					<input id="Doc_type" type="text" name="Doc_type" class="print-field">
					 
					 <ul class="form-style-1" id="form-style-1">
					   <li>
						   <label>Username</label>
						   <div class="inner-addon left-addon">
							   <i class="upload-glyph glyphicon glyphicon-user"></i>
							   <input value="<?php echo $_SESSION['username']; ?>" type="text" name="username" class="form-control field-long">
							</div>
					   </li>
					   <li>
						   <label>Password</label>
						   <div class="inner-addon left-addon">
							   <i class="upload-glyph glyphicon glyphicon-lock"></i>
									<input type="password" name="password" class="form-control field-long">
							</div>
					   </li>
					   <li><div class="row"><div class="col-md-6 left"></div><div class="col-md-6 right"><input type="submit" value="Check user" id="check_user"/></div></div></li>
					   </ul>	  
				 </form> 
			 <a class="close-reveal-modal">&#215;</a>
		</div>
	<div id="download_form" class="reveal-modal" style="z-index:1000;">
			<form method="POST" class='print-down'action="view_doc.php" target="_blank" style="width: 24px;" id="print_form<?php echo $row['id_doc']; ?>">
					 <input id="down_id_doc" type="text" name="id_doc" class="print-field">
					<input id="down_org_id" type="text" name="org_id"class="print-field">
					<input id="down_cat_id" type="text" name="cat_id" class="print-field">
					<input id="down_Doc_type" type="text" name="Doc_type" class="print-field">
					<input id="down_action" type="text" name="Action" class="print-field">
					 
					 <ul class="form-style-1" id="form-style-1">
					   <li>
						   <label>Username</label>
						   <div class="inner-addon left-addon">
							   <i class="upload-glyph glyphicon glyphicon-user"></i>
							   <input value="<?php echo $_SESSION['username']; ?>" type="text" name="username" class="form-control field-long">
							</div>
					   </li>
					   <li>
						   <label>Password</label>
						   <div class="inner-addon left-addon">
							   <i class="upload-glyph glyphicon glyphicon-lock"></i>
									<input type="password" name="password" class="form-control field-long">
							</div>
					   </li>
					   <li><div class="row"><div class="col-md-6 left"></div><div class="col-md-6 right"><input type="submit" value="Check user" id="check_user"/></div></div></li>
					   </ul>	  
				 </form> 
			 <a class="close-reveal-modal">&#215;</a>
		</div>
  </body>
</html>