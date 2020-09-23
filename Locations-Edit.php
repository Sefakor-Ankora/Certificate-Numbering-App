<?php require_once 'includes/initialize.php';

require_once './layouts/header.php';
$location = Location::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if(isset($_POST['submit'])){                
                $location->name = trim($_POST['name']);
                $location->prefix= trim($_POST['prefix']);
                $location->sno = trim($_POST['sno']);
                    $check = Location::check_existing($location->name,$location->id);
                //CHECK if user already exists
            
                if($check){
                    $message = "<div class=\"alert alert-error\">Location already exists!</div>";
                    $session->message($message);
                    redirect_to("Locations-Edit.php?id=".  filter_input(INPUT_GET, "id"));
                    } 
//                $location->save();
               if($location && $location->save()){
                    //// SEND EMAIL FROM HERE
                $message = "<div class=\"alert alert-success\">Location saved successfully</div>";  
               $session->message($message);
                        // do s
                        redirect_to("Locations.php");
                } else {
                    $message = "<div class=\"alert alert-error\">An error occured!</div>";
                }
            }
if(isset($_POST['submit'])){                
    redirect_to("Locations.php");
}            
$p =4;            
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
                               <div><h4>SETTINGS : Modify Location </h4></div>
                               <p>&nbsp;</p>
                        <form id="newform" action="" method="POST">
                                        <div class="span6">
                          <label class="">LOCATION NAME</label>
                          <input type="text"  class="input-block-level required-entry "  placeholder="Input Location" title="Input Location " name="name" required value="<?php echo $location->name  ?>" />
                          <label class="">LOCATION CERTIFICATE PREFIX</label>
                          <input type="text"  class="input-block-level required-entry "  placeholder="Input Location" title="Input Location " name="prefix" required value="<?php echo $location->prefix  ?>" />                                
                          <label class="">LOCATION CERTIFICATE START NO</label>
                          <input type="number"  class="input-block-level required-entry "  placeholder="Input Location" title="Input Location " name="sno" required value="<?php echo $location->sno  ?>" />    
                          <p>&nbsp;</p>
                            
                                <input type="submit" class="btn btn-success btn-large"  name="submit" value="SAVE"/>  
                                <input type="submit" class="btn btn-danger btn-large"  name="cancel" value="CANCEL"/>                                  
             </div>
                        </form>
                           </div>                       
                        </div>
                    </div><!--/row-->
                 
            </div><!--/span-->
            </div><!--/row-->
        </div>
<?php require_once 'layouts/footer.php'; 