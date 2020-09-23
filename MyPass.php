<?php require_once 'includes/initialize.php';
            require_once 'layouts/header.php';
          
            $user = User::find_by_id($session->id);
            if(isset($_POST['submit'])){
                if(md5($_POST['oldpassword']) == $user->password){
                        $user->password = md5(trim($_POST['password']));
                } else {
                    $session->message("<div class=\"alert alert-error\">Old password is incorrect!</div>");
                    redirect_to("MyPass.php");
                    }
                if($user){
                    $user->save();
             
              $message = "<div class=\"alert alert-success\">Password updated successfully<br />Logout and Log in to reflect changes</div>";  
                } else {
                    $message = "<div class=\"alert alert-error\">An error occured!</div>";
                }
            }
?>
    </head>
    <body>
       <?php include_once 'layouts/navigation.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12 hero-unit">
                    <?php  if (isset($message)){ echo $message;}  ?> 
                    <div>
                                           <div id="" class="">
                        <h2 class="">Change Password</h2> 
                    </div>
                        <form id="newform" action="MyPass.php" method="POST" enctype="multipart/form-data">
                                        <div class="span5">
                          <label class="">OLD PASSWORD</label>
                          <input type="password"  class="input-block-level required-entry"  placeholder="Input User Password" title="Input User Password" name="oldpassword" required />                                
                          <label class="">NEW PASSWORD</label>
                          <input type="password"  class="input-block-level required-entry validate-password"  placeholder="Input User Password" title="Input User Password" name="password" required />                                
                          <label class="">CONFIRM NEW PASSWORD</label>
                          <input type="password"  class="input-block-level required-entry validate-cpassword"  placeholder="Input User Password Again" title="Input User Password Again" name="vpassword" required  />
                    </div>
                            <p>&nbsp;</p>
                
                            <div class="span8">
                                <input type="submit" class="btn btn-success btn-large"  name="submit" value="SAVE"/>  
                        </div>
                        </form>
                    </div><!--/row-->
                    </div><!--/row-->
            </div><!--/row-->

            <!-- TODO Add Footer element here -->
             

        </div>
<?php require_once 'layouts/footer.php';