<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
			            <div class="content-wrap">
			                <h6 id="h6"><u>Upload</u></h6>
							
                            <div id="notification" style="padding:20px 0 40px 0; margin: 0 auto;"></div>
							<form class="form-style-9" method="post">
								<ul class="form-style-1" id="form-style-1">
									<li>
										<label>Organizition Name</label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<select name="name" id="name" class="form-control field-long">
                                                <option value="organization">Choose Organization</option>
                                                <?php
                                                $stmt_drop = $DB_con->prepare("SELECT * FROM organization");
                                                $stmt_drop->execute(array());
                                                while($row_drop=$stmt_drop->fetch(PDO::FETCH_ASSOC)){
                                                    echo "<option value='{$row_drop['id']}'>{$row_drop['organization']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
									</li>
                                    <li>
										<label>Categorie</label>
										<div class="inner-addon left-addon">
											<input name="cat" id="cat" class="form-control field-long print-field" >
											<i class="upload-glyph glyphicon glyphicon-user"></i>
											<select onchange='show_subcategories(this.value)' name="categorie" id="categorie" class="form-control field-long" >
                                                <option value="categorie">Choose Categorie</option>
                                                <?php
                                                $stmt_drop = $DB_con->prepare("SELECT * FROM categories");
                                                $stmt_drop->execute(array());
                                                while($row_drop=$stmt_drop->fetch(PDO::FETCH_ASSOC)){
                                                    echo "<option value='{$row_drop['id']}'>{$row_drop['categories']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
									</li>
									<li id="suba-direct">
										
									</li>
                                    <li>
										<label>Choose file</label>
										<div class="inner-addon left-addon">
											
											<input type="file" name="file_to_upload" id="file_to_upload" class="form-control field-long" />
										</div>
									</li>
									<li>
										<label>Descrition</label>
										<div class="inner-addon left-addon">
											<i class="upload-glyph glyphicon glyphicon-comment"></i>
											<textarea name="description" id="description" class="form-control field-long" ></textarea>
										</div>
										
									</li>
									<li><div class="row"><div class="col-md-6 left"></div><div class="col-md-6 right"><input type="button" value="upload this file" onclick="upload_docddd(<?php echo $_SESSION['user_Id'];?>)" id="upload_button"/></div></div></li>
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