<?php
  session_start();
  require_once 'dbconfig.php';

  if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
	$check_user=$user->check_login($_SESSION['username'],$_SESSION['password']);
	if($check_user=="ok"){
	  header("location:dashboard-scan.php");
	}
    
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	  <script src="js/jquery/jquery.min.js"></script>
							  
    <![endif]-->
  </head>
  <body class="login-bg">
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

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6><u>Login</u></h6>
							<?php
							if(isset($_POST['login'])==true){
							  if(trim($_POST['password']," ")!="" || trim($_POST['username']," ")!=""){
								$return=$user->login($_POST['username'],$_POST['password']);
								if($return=="ok"){
								  header("location:dashboard-scan.php");
								}
								?>
								
							  <?php
							  }else{
								
								
							  }
							  
							}
							?>
			                <div class="social">
	                            <div class="division">
	                                <!--<hr class="left">
	                                <span>or</span>
	                                <hr class="right">-->
	                            </div>
	                        </div>
							<form class="form-style-9" method="post">
								<ul class="form-style-1">
									<li>
										<label>Username</label>
										<div class="inner-addon left-addon">
											<i class="glyphicon glyphicon-user"></i>
											<input type="text" name="username" id="username" class="form-control field-long" />
										</div>
									</li>
									<li>
										<label>Password</label>
										<div class="inner-addon left-addon">
											<i class="glyphicon glyphicon-lock"></i>
											<input type="password" name="password" id="password" class="form-control field-long" />
										</div>
										
									</li>
									<li><div class="row"><div class="col-md-6 left"><label><input type="checkbox" name="field2" />Remember me</label></div><div class="col-md-6 right"><input type="submit" name="login" value="Log in"/></div></div></li>
								</ul>
							</form>
							  <div class="already"><p><a href="#">Ask for an Account</a>  |<a href="#">Lost your Password?</a></p></div>
			            </div>
			        </div>

			        <div class="already">
			            <p><u>Terms and Conditions | Privacy</u></p>
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
	<script src="js/ajax_scripts.js"></script>
  </body>
</html>