<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
			            <div class="content-wrap">
			                <h6 id="h6"><u>Change profile</u></h6>
                            <div id="notification" style="padding:20px 0 40px 0; margin: 0 auto;"></div>
							<form class="form-style-9" method="post">
                                <?php
									  $getUser=$_REQUEST['userName'];
									  $stmt = $DB_con->prepare("SELECT * FROM user where user_Id=:id");
									  $stmt->execute(array(':id'=>$getUser));
									  $row=$stmt->fetch(PDO::FETCH_ASSOC);  
								  
							?>
								<ul class="form-style-1" id="form-style-1">
									<li>
										<label>First Name <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<input type="text" name="firstname" id="firstname" class="form-control field-long" value="<?php echo $row['Firstname']; ?>" onkeyup="focussing('firstname')" required/>
                                        </div>
									</li>
                                    <li>
										<label>Second Name <span class="required">*</span></label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<input type="text" name="lastname" id="lastname" class="form-control field-long" value="<?php echo $row['Lastname']; ?>"onkeyup="focussing('lastname')" required/>
                                        </div>
									</li>
                                    <li>
										<label>Gender</label>
										<div class="inner-addon left-addon">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-11">
                                                    <input type="radio" name="gender" id="male" value="male" <?php if($row['Gender']=="male"){ echo "checked";} ?> />male <br>
                                                    <input type="radio" name="gender" id="female" value="female" <?php if($row['Gender']=="female"){ echo "checked";} ?>/> female
                                                </div>
                                            </div>
                                        </div>
									</li>
                                    <li>
										<label>Email </label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-envelope"></i>
											<input type="email" name="email" id="email" class="form-control field-long" value="<?php echo $row['Email']; ?>" onkeyup="focussing('email')" required/>
										</div>
									</li>
                                    <li>
										<label>Telphone </label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-earphone"></i>
											<input type="text" name="telephone" id="telephone" class="form-control field-long" value="<?php echo $row['Phone']; ?>" onkeyup="focussing('telephone')" required/>
										</div>
									</li>
                                    <li>
										<label>Profile picture </label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-picture"></i>
											<input type="file" name="picture" id="picture" class="form-control field-long" onkeyup="focussing('username')" required/>
										</div>
									</li>
									<li><div class="row"><div class="col-md-6 left"></div><div class="col-md-6 right"><input type="button" value="Create user" onclick="changeProfileSumit(<?php echo $row['user_Id']; ?>)" id="create_a_user"/></div></div></li>
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