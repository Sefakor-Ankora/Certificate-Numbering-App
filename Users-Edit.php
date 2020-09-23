<?php require_once 'includes/initialize.php';

$user = User::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if(isset($_POST['submit'])){                
                $user->name = trim($_POST['name']);                
                if( trim(filter_input(INPUT_POST, "password")) != ""){
                $user->password = md5(trim($_POST['password']));
                }
                
                $user->email = trim($_POST['email']);
                $user->role = trim($_POST['role']);                                    
                //CHECK if user already exists

               if($user && $user->save()){
                    //// SEND EMAIL FROM HERE
                $message = "<div class=\"alert alert-success\">User modified successfully</div>";  
               $session->message($message);
                        redirect_to("Users.php");
                } else {
                    $message = "<div class=\"alert alert-error\">An error occured!</div>";
                }
            }
            
            
            if (filter_input(INPUT_POST, "cancel")){
                redirect_to("Users.php");
            }
$p =4;
            require_once './layouts/header.php';
?>
    </head>
    <body>
       <?php include_once 'layouts/navigation.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                   <div class="span2">
                         <?php require_once './layouts/options-settings.php';  ?>
                    </div>
                <div class="span10">
                    <?php  if (isset($message)){ echo $message;}  ?>                    
                    <div class="row-fluid">                        
                           <div class="hero-unit table table-bordered span12">                          
                               <div><h4>SETTINGS : Edit User </h4></div>
                               <p>&nbsp;</p>
                        <form id="newform" action="" method="POST">
                                        <div class="span6">
                          <label class="">NAME</label>
                          <input type="text"  class="input-block-level required-entry"  placeholder="Input Name" title="Input Name" name="name"   value="<?php if (isset($user->name)) {echo $user->name;}  ?>" required />                                
                          <label class="">EMAIL</label>
                          <input type="email"  class="input-block-level validate-email required-entry"  placeholder="Input User Email" title="Input User Email" name="email"   value="<?php if (isset($user->email)) {echo $user->email;}  ?>" required />                                
                          <label class="">PASSWORD</label>
                          <input type="password"  class="input-block-level  validate-password"  placeholder="Input User Password" title="Input User Password" name="password" />                                
                          <label class="">CONFIRM PASSWORD</label>
                          <input type="password"  class="input-block-level  validate-cpassword"  placeholder="Input User Password Again" title="Input User Password Again" name="vpassword"   />
                                <label class="">ROLE</label>
                  <select name="role" class="input-block-level required-entry" required>
                        <option value="" >SELECT ROLE</option>      
                        <option value="officer" <?php if (isset($user) && $user->role == "officer"){ echo "selected"; }  ?>>OFFICER</option>
                        <option value="administrator" <?php if (isset($user) && $user->role == "administrator"){ echo "selected"; }  ?>>ADMINISTRATOR</option>
                        </select>       
    
                          <p>&nbsp;</p>                            
                                <input type="submit" class="btn btn-success btn-large"  name="submit" value="SAVE"/>
                                <input type="submit" class="btn btn-danger btn-large" value="CANCEL" name="cancel" />                        
             </div>
                        </form>
                           </div>                       
                        </div>
                    </div><!--/row-->
                 
            </div><!--/span-->
            </div><!--/row-->

            <!-- TODO Add Footer element here -->
             
<script type="text/javascript">
            
             function search(){
                 var  svalue = document.getElementById('svalue');
                 var column = document.getElementById('column');
                 var results = document.getElementById('results');
                results.innerHTML = "<img src=\"img/loader.gif\" width='25' height='25'  />PLEASE WAIT...";
        if(window.XMLHttpRequest) {
                            mlhttp=new XMLHttpRequest();
                            }
                            else  {
                            mlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            mlhttp.onreadystatechange=function(){
                    if (mlhttp.readyState===4 && mlhttp.status===200){
//                        alert(mlhttp.responseText);
                    results.innerHTML = mlhttp.responseText;
                    var myScripts = editdiv.getElementsByTagName("script");
                                    if (myScripts.length > 0) {
                                    eval(myScripts[0].innerHTML);
                                    }
                        }
                    };
                            mlhttp.open("GET","AjaxSnippets/search.php?p=2&category=lmcs&svalue=" + svalue.value + "&column="+column.value,true);
                            mlhttp.send();	
                            
        }
             </script>
        </div>
<?php require_once 'layouts/footer.php'; 