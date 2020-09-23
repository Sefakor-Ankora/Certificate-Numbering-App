<?php require_once 'includes/initialize.php';

    if(isset($_POST['submit'])){
                $location = new Location();
                $location->name = trim($_POST['name']);
                $location->prefix= trim($_POST['prefix']);
                $location->sno = trim($_POST['sno']);
                    $check = Location::check_existing($location->name,0);
                //CHECK if user already exists
            
                if($check){
                    $message = "<div class=\"alert alert-error\">Location already exists!</div>";
                    $session->message($message);
                    redirect_to("Locations-Add.php");
                    } 
//                $location->save();
               if($location && $location->save()){
                    //// SEND EMAIL FROM HERE
                $message = "<div class=\"alert alert-success\">Location saved successfully</div>";  
               $session->message($message);
                    if ($_POST['action'] == 1 ){
                        // do s
                        redirect_to("Locations.php");
                    } else if ($_POST['action'] == 2 ){
                      //
                        redirect_to("Locations-Add.php?action={$_POST['action']}");
                    }
                } else {
                    $message = "<div class=\"alert alert-error\">An error occured!</div>";
                }
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
                               <div><h4>SETTINGS : New Location </h4></div>
                               <p>&nbsp;</p>
                        <form id="newform" action="" method="POST">
                                        <div class="span6">
                          <label class="">LOCATION NAME</label>
                          <input type="text"  class="input-block-level required-entry "  placeholder="Input Location" title="Input Location " name="name" required />                                
                          <label class="">LOCATION CERTIFICATE PREFIX</label>
                          <input type="text"  class="input-block-level required-entry "  placeholder="Input Location" title="Input Location " name="prefix" required />                                
                          <label class="">LOCATION CERTIFICATE START NO</label>
                          <input type="number"  class="input-block-level required-entry "  placeholder="Input Location" title="Input Location " name="sno" required />
    
                  <label class="">ACTION</label>
                                           <select name="action" class="input-block-level">
                            <option value="1" <?php if (isset($action) && $action==1){ echo "selected";}  ?>>SAVE AND VIEW ALL LOCATIONS</option>
                            <option value="2" <?php if (isset($action) && $action==2){ echo "selected";}  ?>>SAVE AND ADD NEW</option>
                        </select>  
                          <p>&nbsp;</p>
                            
                                <input type="submit" class="btn btn-success btn-large"  name="submit" value="SAVE"/>  <input type="reset" class="btn btn-warning btn-large" value="CLEAR FORM" />                        
             </div>
                        </form>
                           </div>                       
                        </div>
                    </div><!--/row-->
                 
            </div><!--/span-->
            </div><!--/row-->
        </div>
<?php require_once 'layouts/footer.php'; 