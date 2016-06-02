<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
			            <div class="content-wrap">
			                <h6 id="h6"><u>Change Password</u></h6>
							
                            <div id="notification" style="padding:20px 0 40px 0; margin: 0 auto;"></div>
							<form class="form-style-9" method="post">
								<ul class="form-style-1" id="form-style-1">
									<li>
										<label>Current Password <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-lock"></i>
											<input type="password" name="current" id="current" class="form-control field-long" onkeyup="focussing('current')" required/>
                                        </div>
									</li>
                                    <li>
										<label>New Password <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-lock"></i>
											<input type="password" name="new" id="new" class="form-control field-long" onkeyup="focussing('new')" required/>
                                        </div>
									</li>
                                    <li>
										<label>Retype Password <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-lock"></i>
											<input type="password" name="retype" id="retype" class="form-control field-long" onkeyup="focussing('retype')" required/>
                                        </div>
									</li>
									<li><div class="row"><div class="col-md-6 left"></div><div class="col-md-6 right"><input type="button" value="Create user" onclick="changPassSumit('<?php echo $_SESSION['username']; ?>')" id="create_a_user"/></div></div></li>
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