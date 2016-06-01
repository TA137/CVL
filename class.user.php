<?php
class USER
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function register($firstname,$lastname,$gender,$username)
	{
		try
		{
				$password=md5("123456");
			$stmt = $this->db->prepare("INSERT INTO user(Firstname,Lastname,Gender,username,password) 
		                                               VALUES(:firstname, :lastname, :gender,:username ,:password)");
			$stmt->bindparam(":firstname", $firstname);
			$stmt->bindparam(":lastname", $lastname);
			$stmt->bindparam(":gender", $gender);
			$stmt->bindparam(":username", $username);
			$stmt->bindparam(":password", $password);	
			$stmt->execute();
			return "registered";	
		}
		catch(PDOException $e)
		{
			return "not_registered";
		}
		
	}
	public function upload($user_Id,$name,$categorie,$file_ext,$file_name,$description)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO upload_doc(org_id,cat_id,Doc_name,Doc_type,description,user_Id) 
		                                               VALUES(:org, :cat,:name,:type,:desc,:user_id)");
			$stmt->bindparam(":org", $name);
			$stmt->bindparam(":cat", $categorie);
			$stmt->bindparam(":name", $file_name);
			$stmt->bindparam(":type", $file_ext);
			$stmt->bindparam(":desc", $description);
			$stmt->bindparam(":user_id", $user_Id);
			$stmt->execute();
			return $this->db->lastInsertId();	
		}
		catch(PDOException $e)
		{
			return "not done".$e;
		}
		
	}
	public function register_user($id,$fname,$lname,$title,$comp,$event_id)
	{
		try
		{
			$sql="INSERT INTO conference_tb(Id,";
			if($fname!=""){$sql=$sql."Fname,";}if($lname!=""){$sql=$sql."Lname,";}if($title!=""){$sql=$sql."Title,";}
			if($comp!=""){$sql=$sql."Company,";} $sql=$sql."Event_id) VALUES(:id,";if($fname!=""){$sql=$sql.":fname,";}if($lname!=""){$sql=$sql.":lname,";}if($title!=""){$sql=$sql.":title ,";}
			if($comp!=""){$sql=$sql.":company,";} $sql=$sql.":event_id)";
			$stmt = $this->db->prepare($sql);
			$stmt->bindparam(":id", $id);
			if($fname!=""){
			$stmt->bindparam(":fname", $fname);
			}
			if($lname!=""){
			$stmt->bindparam(":lname", $lname);
			}
			if($title!=""){
			$stmt->bindparam(":title", $title);
			}
			if($comp!=""){
			$stmt->bindparam(":company", $comp);
			}
			$stmt->bindparam(":event_id", $event_id);	
			$stmt->execute();
			return $stmt;	
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	public function login($username,$password)
	{
		try
		{
				$stmt = $this->db->prepare("SELECT * from user where username=:username or Email=:email");
				$stmt->execute(array(":username"=>$username,":email"=>$username));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				if(empty($row['user_Id']) ==false){
						if(MD5($password)== $row['password']){
								// Identity
								$_SESSION['user_Id'] = $row['user_Id'];
								$_SESSION['username'] = $row['username'];
								$_SESSION['password'] = $row['password'];
								// privilages ----------------------------------
								$_SESSION['userType'] = $row['Type'];
								$_SESSION['Print'] = $row['Print'];
								$_SESSION['Download'] = $row['Download'];
								$_SESSION['Upload'] = $row['Upload'];
								return "ok";
						}else{
								return "wrong password";
						}
				}else{
						return 'Username and Password are not found';
				}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	public function check_login($username,$password)
	{
		try
		{
				$stmt = $this->db->prepare("SELECT * from user where username=:username or Email=:email");
				$stmt->execute(array(":username"=>$username,":email"=>$username));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				if(empty($row['user_Id']) ==false){
						if($password== $row['password']){
								return "ok";
						}else{
								return "wrong password";
						}
				}else{
						return 'Username and Password are not found';
				}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	public function check_username($username)
	{
		try
		{
				$stmt = $this->db->prepare("SELECT * from user where username=:username");
				$stmt->execute(array(":username"=>$username));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				if(empty($row['user_Id']) ==false){
						return 'user_exist';
				}else{
						return "user_unfound";
				}
		}
		catch(PDOException $e)
		{
			return "user_exist";
		}
		
	}
	public function changePass($username,$current,$newPass)
	{
		try
		{
			$stmt = $this->db->prepare("UPDATE user set password=:newpass where username=:user and password=:pass");
			$stmt->bindparam(":newpass", $newPass);
			$stmt->bindparam(":user", $username);
			$stmt->bindparam(":pass", $current);	
			$stmt->execute();
			return "pass changed";
		}
		catch(PDOException $e)
		{
			return "incorrect_pass";
		}
		
	}
	public function detail_on($id,$field)
	{
		try
		{
				$stmt = $this->db->prepare("SELECT * from user where user_Id=:id");
                $stmt->execute(array(":id"=>$id));
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
				if($row[$field]){
						echo "true";
					return true;
				}else{
						echo "false";
					return false;
				}
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function change_details($id,$field)
	{
		try
		{
			if($this->detail_on($id,$field))
			{
				$values=0;
				echo "changed<br>".$values.$field;
				echo "<br>wallah";
			}else
			{
				$values=1;
				echo "changed1<br>".$values.$field;
				echo "<br>aristide";
			}
		$stmt = $this->db->prepare("update user set ".$field."=:values where user_Id=:id");										  
		$stmt->bindparam(":values", $values);
		$stmt->bindparam(":id", $id);
		$stmt->execute();
		return "ok";
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function change_profile($id,$firstname,$lastname,$gender,$phone,$emailAddress,$picture)
	{
		try
		{
				$stmt = $this->db->prepare("update user set Firstname=:fname,Lastname=:lname,Gender=:gender,Picture=:picture,Phone=:phone,Email=:email where user_Id=:id");										  
				$stmt->bindparam(":fname", $firstname);
				$stmt->bindparam(":lname", $lastname);
				$stmt->bindparam(":gender", $gender);
				$stmt->bindparam(":picture", $picture);
				$stmt->bindparam(":phone", $phone);
				$stmt->bindparam(":email", $emailAddress);
				$stmt->bindparam(":id", $id);
				$stmt->execute();
				return "updated";
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}


?>