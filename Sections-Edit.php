<?php require_once 'includes/initialize.php';

$section = Section::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if(isset($_POST['submit'])){                
                $section->no = trim($_POST['no']);
                $section->name = trim($_POST['name']);
                $section->volume = trim($_POST['volume']);
                $section->user = $session->id;
                $section->location = $session->location;
                    $check = Section::check_existing($section->volume,$section->name,$section->id,$session->location,$section->no);
                //CHECK if user already exists                    
                    
                    
                    
                if($check){
                    $message = "<div class=\"alert alert-error\">Section already exists!</div>";
                    $session->message($message);
                    redirect_to("Sections-Edit.php?id=".  base64_encode($section->id));
                    } 
//                $section->save();
               if($section && $section->save()){
                    //// SEND EMAIL FROM HERE
                $message = "<div class=\"alert alert-success\">Section modified successfully</div>";  
               $session->message($message);
                        redirect_to("Sections.php");

                } else {
                    $message = "<div class=\"alert alert-error\">An error occured!</div>";
                }
            }
                                    
            if (filter_input(INPUT_POST, "cancel")){
                redirect_to("Sections.php");
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
                               <div><h4>SETTINGS : Edit Section </h4></div>
                               <p>&nbsp;</p>
                        <form id="newform" action="" method="POST">
                                        <div class="span6">
                          <label class="">SELECT VOLUME NO</label>
                          <select name="volume" class="input-block-level required-entry" required="" >
                              <option value="">PLEASE SELECT</option>
                              <?php $volumes = Volume::find_all_by_location(1); if ($volumes){
                                                    foreach ($volumes as $volume) { ?>
                              <option value="<?php echo $volume->id ?>" <?php if ($section->volume == $volume->id) { echo "selected";}  ?>><?php echo $volume->no ?></option>
                              <?php                 }
                              } else { echo "<h4 class='alert alert-info'>No Volumes Found</h4>";}  ?>
                          </select>
                          <label class="">SECTION NAME</label>
                          <input value="<?php echo $section->name ?>" type="text"  class="input-block-level required-entry"  placeholder="Input Section Name" title="Input Section Name" name="name" required  />
                          <label class="">SECTION NO</label>
                          <input value="<?php echo $section->no  ?>" type="text"  class="input-block-level  "  placeholder="Input Section No" title="Input Section No" name="no"  />
       
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

        </div>
<?php require_once 'layouts/footer.php'; 