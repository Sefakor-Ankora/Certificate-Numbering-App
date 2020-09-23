<?php
            require_once 'includes/initialize.php';
    
    if($session->is_logged_in()){
    redirect_to("portal.php");
   }
   
    if (isset($_POST['login'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
//        echo $username . " " . $password ;
//                exit('adsfasd');
        //Check database to see if username / password exist
        $found_user = User::authenticate($username, $password);       
        if ($found_user  && $found_user->deleted==0){
            $b = Location::find_by_id(filter_input(INPUT_POST, "location"));
            $session->login($found_user,  filter_input(INPUT_POST, "location"),$b->name);
            redirect_to("portal.php");
        } else{
            $message = "<div class='alert-error'>Email / Password Combination incorrect</div>";
        }

    } else {
        if (isset($_GET['message'])){
             $message = "<div class='alert-info'>You have been logged out</div>";
        }else {
        $message = "";
        $password = ""; 
        }
    }
   
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
        <title>LANDS COMMISSION</title>
					<!-- reset and font stylesheet -->
		<link rel="stylesheet" type="text/css" href="templates/standard/style/reset-fonts-grids.css" />		<!-- common stylesheet -->
		<link rel="stylesheet" type="text/css" href="templates/standard/style/base.css" />
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="templates/standard/style/lms-home.css" />
				<!-- specific stylesheet -->
				<!-- printer stylesheet-->
                                <script src="js/jquery.js" type="text/javascript"></script>
                                <script type="text/javascript" src="js/prototype/validation.js"></script>
		<style type="text/css">
.access-only {display: none;}
        </style>
		<!-- Page Head area -->
		<!-- yui css -->
		<link rel="stylesheet" type="text/css" href="templates/standard/yui-skin/button.css" />
		
		<link rel="stylesheet" type="text/css" href="templates/standard/yui-skin/container.css" />
		<link rel="stylesheet" type="text/css" href="templates/standard/yui-skin/menu.css" />
		<!-- yui js -->
		        <style type="text/css">
<!--
.style3 {color: #FF0000}
a:link {
	text-decoration: none;
	color: #06C;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #F63;
}
a:active {
	text-decoration: none;
}
-->
                </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

    <body class="yui-skin-docebo yui-skin-sam">

<div class="header">
		  <div class="nofloat"></div>
		</div>
	<div class="content">
            <h3 class="style3"><?php if (isset($message)){ echo " {$message} " ; } ?></h3>
<div class="login-box">
<form  class="std_form" id="login_confirm" method="post" action="">
    <div class="login-line">
        <input class="textfield" autofocus type="email" id="login_userid" name="username" value="<?php if (isset($username)){ echo $username; } ?>" maxlength="255" tabindex="1" title="Input email" placeholder="ENTER EMAIL" required />
    </div>        
        <div class="login-line">            
            <input class="textfield" type="password" id="login_pwd" title="Input password" name="password" maxlength="255" tabindex="2" autocomplete="off" required placeholder="ENTER PASSWORD" />
        </div>
            <div class="login-line">
                <select name="location" required="" tabindex="3">
                <option value="">Select Location</option>
                <?php $locations = Location::find_all(); if ($locations){
                    foreach ($locations as $location){ ?>
                <option value="<?php  echo $location->id ?>"><?php  echo $location->name  ?></option>
                    <?php  }
                }  ?>
                
            </select>
        </div>        
        <div class="login-line">
            <input style="cursor: pointer" class="button" type="submit" id="login" name="login" value="Login" tabindex="4" />
        </div>        
</form>	    
</div>  
            
</div>
<div class="footer">
    
      <table width="75%" border="0">
        <tr>
          <td width="50%"><div id="link"></div></td>
          <td width="30%"></td>
          <td width="20%"><span class="copyright">Powered by <a style=" cursor:pointer" target="_new"href="sefakor@outlook.com">Sefakor</a> <sup>&reg;</sup></span></td>
        </tr>
      </table>	
</div>
    <script type="text/javascript">
        function setfocus(){
               var pass = document.getElementById('login_pwd');
    pass.focus();
        }
</script>
</body>
</html>
