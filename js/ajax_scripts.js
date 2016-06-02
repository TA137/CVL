function upload_docddd(user_Id) {
      var categorie = document.getElementById("categorie").value;
      var name = document.getElementById("name").value;
      var file_to_upload=document.getElementById("file_to_upload").value;
      var description=document.getElementById("description").value;
	  if (file_to_upload.trim()=="" || name.trim()=="organization" || name.trim()=="" || categorie.trim()=="" || categorie=="categorie"){
	      if(name=="organization" || name.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Organization name not Given</div>";
	      } else if(categorie=="categorie" || categorie.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Give Categorie</div>";
	      }else if(file_to_upload.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Browse for a file!</div>";
	      }
	  
	  return false;
      }else{
	var formData = new FormData();
	formData.append('upload_doc',$('input[type=file]')[0].files[0]);
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	     if (xhttp.readyState == 4 && xhttp.status == 200) {
	       document.getElementById("notification").innerHTML = xhttp.responseText;
	       document.getElementById('name').value='Choose Organization';
               document.getElementById('categorie').value='Choose Categorie';
               document.getElementById('file_to_upload').value='';
               document.getElementById('description').value='';
	     }
	};
	xhttp.open("POST", "upload_doc.php?user_Id="+user_Id+"&name="+name+"&categorie="+categorie+"&description="+description, true);
	xhttp.send(formData);
	
	return false;
    }
}
$(document).ready(function(){
  $(".myItem").click(function(){
    var contentPanelId = jQuery(this).attr("id");
		    $("#item21").fadeOut(1000);
		});
    $(".my-link").click(function(){
	var contentPanelId = jQuery(this).attr("id");
	$('.show_').removeClass("show_").addClass("hide");
	$('#edit-table-'+contentPanelId).removeClass("hide").addClass("show_");
    });
      
    $("#add_a_user").click(function(){
        var loadPHP = "add_user.php";
        $("#pageContent").load("add_user.php");
    });  
});
function login() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      if(username.trim()=="" || password.trim()==""){
	      if(username.trim()==""){ 
                 $("#username").css("border","1px solid red");
          }
          if(password.trim()==""){
                $("#password").css("border","1px solid red");
          }
	  return false;
      }else{
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	     if (xhttp.readyState == 4 && xhttp.status == 200) {
                        if(xhttp.responseText=="Username and Password are not found"){ 
                               $("#username").css("border","1px solid red");
                               $("#password").css("border","1px solid red");
                        }
                        if(xhttp.responseText=="wrong password"){
                              $("#password").css("border","1px solid red");
                        }
	       //document.getElementById("notification").innerHTML = xhttp.responseText; tooltip="Hi, I'm a tooltip. Pretty easy uh ? ;)"
	       //document.getElementById('name').value='Choose Organization';
               //document.getElementById('categorie').value='Choose Categorie';
               //document.getElementById('file_to_upload').value='';
               //document.getElementById('description').value='';*/
	     }
	};
	xhttp.open("POST", "ajax_php.php?username="+username+"&password="+password, true);
	xhttp.send();
	return false;
    }
}

function upload() {
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	     if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById("right-body").innerHTML = xhttp.responseText;  
	     }
	};
	xhttp.open("POST", "upload-doc.php", true);
	xhttp.send();
	
	return false;
}
function selectFolders() {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("POST", "select_folders.php", true);
        xhttp.send();
        
        return false;
}
function insideFolders(id) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("POST", "inside-folder.php?folder_id="+id, true);
        xhttp.send();
        
        return false;
}
function createUsers() {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("POST", "create-user.php", true);
        xhttp.send();
        
        return false;
}
function createUsersSumit() {
        var firstname = document.getElementById("firstname").value;
        var lastname = document.getElementById("lastname").value;
        var gender;
        if(document.getElementById("male").checked == true) {
               gender=document.getElementById("male").value;
        }else if(document.getElementById("female").checked == true){
               gender=document.getElementById("female").value;
        }else{
                gender="";
        }
        var username=document.getElementById("username").value;
        if (firstname.trim()=="" || lastname.trim()=="" || username.trim()==""){
             
            if(username.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Give username</div>";
                 $("#username").css("border","1px solid red");
            }
            if(lastname.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Insert Second name</div>";
                 $("#lastname").css("border","1px solid red");
            }
            if(firstname.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Insert First name</div>";
                $("#firstname").css("border","1px solid red");
            }
        return false;
      }else{
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                        if (xhttp.responseText=="user_exist"){
                               document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Username Exists!</div>";
                                $("#username").css("border","1px solid red"); 
                        }else{
                                if(xhttp.responseText=="registered"){
                                        document.getElementById("notification").innerHTML = "<div class='alert alert-success'>Username:"+username+"</div>";
                                }
                                else if(xhttp.responseText=="not_registered") {
                                        document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Username not created try again later!</div>"; 
                                }
                } 
             }
        };
        xhttp.open("POST", "ajax_php.php?firstname="+firstname+"&lastname="+lastname+"&gender="+gender+"&username="+username, true);
        xhttp.send();
        
        return false;
      }
}
function changePass() {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("POST", "change-pass.php", true);
        xhttp.send();
        
        return false;
}
function changPassSumit(username){
        var current = document.getElementById("current").value;
        var newPass = document.getElementById("new").value;
        var retype=document.getElementById("retype").value;
        if (current.trim()=="" || newPass.trim()=="" || retype.trim()=="" || newPass.trim()!=retype.trim()){
              if (newPass.trim()!=retype.trim()) {
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>password not much</div>";
                $("#new").css("border","1px solid red");
                $("#retype").css("border","1px solid red");
              }
             if(retype.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Retype new Password</div>";
                $("#retype").css("border","1px solid red");
            }
            if(newPass.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>type new password</div>";
                 $("#new").css("border","1px solid red");
            }
            if(current.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Insert current password</div>";
                 $("#current").css("border","1px solid red");
            }
            
        return false;
      }else{
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                if (xhttp.responseText=="incorrect_pass"){
                       document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Incorrect password</div>";
                        $("#cerrent").css("border","1px solid red"); 
                }else if(xhttp.responseText=="pass changed"){
                        document.getElementById("notification").innerHTML = "<div class='alert alert-success'>password changed</div>";
                        document.getElementById('current').value='';
                        document.getElementById('new').value='';
                        document.getElementById('retype').value='';
                        $("#cerrent").css("border","1px solid #88D5E9");
                        $("#new").css("border","1px solid #88D5E9");
                        $("#retype").css("border","1px solid #88D5E9");
                } 
             }
        };
        xhttp.open("POST", "ajax_php.php?current="+current+"&newPass="+newPass+"&user="+username, true);
        xhttp.send();
        
        return false;
      }
}
function changeProfile(id){
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("POST", "change-profile.php?userName="+id, true);
        xhttp.send();
        
        return false;
}
function changeProfileSumit(id){
       try {
        var firstname = document.getElementById("firstname").value;
        var lastname = document.getElementById("lastname").value;
        var gender;
        if(document.getElementById("male").checked == true) {
               gender=document.getElementById("male").value;
        }else if(document.getElementById("female").checked == true){
               gender=document.getElementById("female").value;
        }else{
                gender="";
        }
        var emailAddress=document.getElementById("email").value;
        var phone=document.getElementById("telephone").value;
        if (firstname.trim()=="" || lastname.trim()=="" || phone.trim()=="" || phonenumber(phone)==false || emailAddress.trim()=="" || emailAddressFunction(emailAddress)==false){
             if(emailAddressFunction(emailAddress)==false || emailAddress.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Invalid Email address</div>";
                 $("#email").css("border","1px solid red");
            }
            if(phonenumber(phone)==false || phone.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Invalid phone number</div>";
                 $("#telephone").css("border","1px solid red");
            }
            if(lastname.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>lastname required</div>";
                 $("#lastname").css("border","1px solid red");
            }
             if(firstname.trim()==""){
                document.getElementById("notification").innerHTML = "<div class='alert alert-danger'>Firstname required</div>";
                $("#firstname").css("border","1px solid red");
            }
            
        return false;
      }else{
        var formData = new FormData();
        formData.append('profile_pic',$('input[type=file]')[0].files[0]);
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("notification").innerHTML = xhttp.responseText; 
             }
        };
        xhttp.open("POST", "change-profileSubmit.php?user_Id="+id+"&firstname="+firstname+"&lastname="+lastname+"&gender="+gender+"&emailAddress="+emailAddress+"&phone="+phone, true);
        xhttp.send(formData);
        
        return false;
      }
       }catch(error){
        alert(error);
       }
}
function changePrivilages(){
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("POST", "change-privilages.php", true);
        xhttp.send();
        
        return false;
}
function change_details(id,field) {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		  // do nothing
		}
	    };
	    xmlhttp.open("GET", "ajax_php.php?require_id="+id+"&field="+field, true);
	    xmlhttp.send();
}
function phonenumber(phone) {
        
        if (/^\(?([0-9]{3})\)?[]?([0-9]{3})[]?([0-9]{4})$/.test(phone))  
        {
          return (true)  
        }
          return (false)  
}
function emailAddressFunction(email) {
        
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))  
        {  
          return (true)  
        }  
          return (false)  
}
function view_doc(action,id,org_id,cat_id,doc_type) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
             if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("right-body").innerHTML = xhttp.responseText;  
             }
        };
        xhttp.open("GET", "view_doc.php?doc_id="+id+"&org_id="+org_id+"&cat_id="+cat_id+"&Doc_type="+doc_type+"&Action="+action, true);
        xhttp.send();
        
        return false;
}