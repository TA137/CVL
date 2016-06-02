<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
			            <div class="content-wrap">
			                <h6 id="h6"><u>Create User</u></h6>
							
                            <div id="notification" style="padding:20px 0 40px 0; margin: 0 auto;"></div>
							<form class="form-style-9" method="post">
								<ul class="form-style-1" id="form-style-1">
									<li>
										<label>First Name <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<input type="text" name="firstname" id="firstname" class="form-control field-long" onkeyup="focussing('firstname')" required/>
                                        </div>
									</li>
                                    <li>
										<label>Second Name <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<input type="text" name="lastname" id="lastname" class="form-control field-long" onkeyup="focussing('lastname')" required/>
                                        </div>
									</li>
                                    <li>
										<label>Gender</label>
										<div class="inner-addon left-addon">
                                            <input type="radio" name="gender" id="male" value="male" /> male <br>
											<input type="radio" name="gender" id="female" value="female"/> female
                                        </div>
									</li>
									<li>
										<label>Username <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<input type="text" name="username" id="username" class="form-control field-long" onkeyup="focussing('username')" required/>
										</div>
									</li>
									<li><div class="row"><div class="col-md-6 left"></div><div class="col-md-6 right"><input type="button" value="Create user" onclick="createUsersSumit()" id="create_a_user"/></div></div></li>
								</ul>
							</form>
			            </div>
                    </div>
    <div class="col-md-3"></div>
</div>
<?php }
		else{
			header('location:login.php');
		}
?>