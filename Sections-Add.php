<?php require_once 'includes/initialize.php';

    if(isset($_POST['submit'])){
                $section = new Section();
                $section->no = trim($_POST['no']);
                $section->name = trim($_POST['name']);
                $section->volume = trim($_POST['volume']);
                $section->user = $session->id;
                $section->location = $session->location;
                    $check = Section::check_existing($section->volume,$section->name,0,$session->location,$section->no);
                //CHECK if user already exists
            
                if($check){
                    $message = "<div class=\"alert alert-error\">Section already exists!</div>";
                    $session->message($message);
                    redirect_to("Sections-Add.php");
                    } 
//                $section->save();
               if($section && $section->save()){
                    //// SEND EMAIL FROM HERE
                $message = "<div class=\"alert alert-success\">Section saved successfully</div>";  
               $session->message($message);
                    if ($_POST['action'] == 1 ){
                        // do s
                        redirect_to("Sections.php");
                    } else if ($_POST['action'] == 2 ){
                      //
                        redirect_to("Sections-Add.php?action={$_POST['action']}");
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
                               <div><h4>SETTINGS : New Section </h4></div>
                               <p>&nbsp;</p>
                        <form id="newform" action="" method="POST">
                                        <div class="span6">
                          <label class="">SELECT VOLUME NO</label>
                          <select name="volume" class="input-block-level required-entry" required="" >
                              <option value="">PLEASE SELECT</option>
                              <?php $volumes = Volume::find_all_by_location(1); if ($volumes){
                                                    foreach ($volumes as $volume) { ?>
                              <option value="<?php echo $volume->id ?>"><?php echo $volume->no ?></option>
                              <?php                 }
                              } else { echo "<h4 class='alert alert-info'>No Volumes Found</h4>";}  ?>
                          </select>
                          <label class="">SECTION NAME</label>
                          <input type="text"  class="input-block-level required-entry"  placeholder="Input Section Name" title="Input Section Name" name="name" required  />
                          <label class="">SECTION NO</label>
                          <input type="text"  class="input-block-level  "  placeholder="Input Section No" title="Input Section No" name="no"  />
    
                  <label class="">ACTION</label>
                       <select name="action" class="input-block-level">
                            <option value="1" <?php if (isset($action) && $action==1){ echo "selected";}  ?>>SAVE AND VIEW ALL SECTIONS</option>
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