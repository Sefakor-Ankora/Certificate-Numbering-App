<?php require_once 'includes/initialize.php';
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
                       <h4>SETTINGS : Sections </h4>
                                                                        <form>
      <input  name="filter" onkeyup="filterTable(this, sf)" placeholder="Enter Search Value" type="text" autofocus />
    </form>  
                        <table class="table-bordered table" id="sf">
                              <thead style="position: relative">
                              <th style="width: 10%">Section No.</th>                              
                              <th>Sections</th>                              
                              <th style="width: 10%">District</th>                              
                          </thead>
                          <?php                     
                          $volumes = Volume::find_all();
                            if($volumes){
                                  foreach ($volumes as $volume){  
                              ?>
                          <tr>                                                                                  
                              <td style="vertical-align: top"><?php echo $volume->no  ?></td>
                              <td>
                                  <table class="table table-bordered table-striped">
                                        <tr>
                                            <?php $sections = Section::find_for_volume($volume->id,$session->location); if ($sections){
                                                    foreach ($sections as $section) {  ?>
                                            <td>
                                                <?php echo $section->no . "  -  ". $section->name  ?>
                                                        <a href="Sections-Edit.php?id=<?php echo base64_encode($section->id)  ?>"><img title="View / Edit" src="img/edit.jpg" width="15px" height="15px" /></a>    <a href="Delete.php?id=<?php  echo base64_encode($section->id) ?>&s=section"onclick="return confirm('Remove?')" title="Remove"><img src="img/remove.png" width="15px" height="15px" /></a> 
                                            </td>
                                               <?php  }
                                            }  ?>
                                        </tr>
                                  </table>
                              </td>
                              <td style="vertical-align: top"><?php  echo $volume->district ?></td>
                            </tr>
                                  <?php  }} else { ?>
                            <tr>
                                <td colspan="7"><div class="alert-info">NO SECTIONS FOUND. <a href="Sections-Add.php">Add </a> new Section</div></td>
                            </tr>
                         <?php  } ?>
                        </table>
                    </div>                       
                        </div>
                    </div><!--/row-->
                 
            </div><!--/span-->
            </div><!--/row-->

        </div>
<?php require_once 'layouts/footer.php'; 
