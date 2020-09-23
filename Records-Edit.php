<?php require_once 'includes/initialize.php';
            $p =1;
            $record = Record::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
            require_once './layouts/header.php';
            if(isset($_POST['submit'])){                
                $record->cno  = trim(filter_input(INPUT_POST, "cno"));
                $record->prop  = trim(filter_input(INPUT_POST, "prop"));
                $record->amtpaid  = trim(filter_input(INPUT_POST, "amtpaid"));
                $record->doi  = trim(filter_input(INPUT_POST, "doi"));
                $record->dol  = trim(filter_input(INPUT_POST, "dol"));
                $record->lno  = trim(filter_input(INPUT_POST, "lno"));
                $record->pno  = trim(filter_input(INPUT_POST, "pno"));
                $record->plno  = trim(filter_input(INPUT_POST, "plno"));                                      
                $record->remarks = trim(filter_input(INPUT_POST, "remarks"));
                $record->user = $session->id;                                
                $check = Record::check_existing($record->cno,$record->id,$session->location);
            if ($check){
                    $message = "<div class=\"alert alert-error\">Certificate NO. already exists!</div>";
                } else if($record && $record->save()){
                    // if we were able to create the lmc and save it we 
                    // do the following
              $message = "<div class=\"alert alert-success\">Record saved successfully<br />Volume No is <b>{$record->volume}</b><br />Folio No is <b>{$record->folio}</b></div>";  
               $session->message($message);
                                       if (filter_input(INPUT_GET, "d") == 0){
                        redirect_to("Records.php");       
               } else if (filter_input(INPUT_GET, "d")==1) {
                   redirect_to("Records-Details.php?id=".filter_input(INPUT_GET, "id"));
               }
                } else {
                    $message = "<div class=\"alert  alert-error\">An error occured!</div>";
                }
            }
            
                     if (filter_input(INPUT_POST, "cancel")){
                               if (filter_input(INPUT_GET, "d") == 0){
                        redirect_to("Records.php");       
               } else if (filter_input(INPUT_GET, "d")==1) {
                   redirect_to("Records-Details.php?id=".filter_input(INPUT_GET, "id"));
               }
            }
?>
    </head>
    <body>
       <?php include_once 'layouts/navigation.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                                    <div class="span2">
                         <?php require_once './layouts/options-records.php';  ?>
                    </div>  
                <div class="span10">
                    <?php  if (isset($message)){ echo $message;}  ?>
  
                    <div class="row-fluid hero-unit">
                                          <div id="" class="">
                        <h4>Modify Record for  <?php  echo $session->locname  ?></h4> 
                        <p>&nbsp;</p>
                    </div>
                        <form id="newform" action="" method="POST">
                             <div class="span6">
                          <label class="">CERTIFICATE NO.</label>
                          <input readonly="" type="text" name="cno" value="<?php  echo $record->cno ?>" class="input-block-level required-entry"  required="" />
                          <label class="">PROPRIETOR.</label>
                          <input type="text" name="prop" value="<?php  echo $record->prop ?>" class="input-block-level required-entry"  required="" />
                          <label class="">AMOUNT PAID</label>
                          <input type="text" name="amtpaid" value="<?php  echo $record->amtpaid ?>" class="input-block-level required-entry"  required="" />
                          <label class="">ISSUE DATE</label>
                          <input type="date" id="datepicker" name="doi" value="<?php  echo $record->doi ?>" class="input-block-level required-entry"  required="" />
                          <label class="">LODGEMENT DATE</label>
                          <input type="date" id="datepicker1" name="dol" value="<?php  echo $record->dol ?>" class="input-block-level required-entry"  required="" />
                          <label class="">LODGEMENT NO.</label>
                          <input type="text" name="lno" value="<?php  echo $record->lno ?>" class="input-block-level required-entry"  required="" />
                            <label class="">PARCEL NO.</label>
                          <input type="text" name="pno" value="<?php  echo $record->pno ?>" class="input-block-level required-entry"  required="" />
                        </div>
                            <div class="span6">
                            <label class="">PLAN NO.</label>
                          <input type="text" name="plno" value="<?php  echo $record->plno ?>" class="input-block-level required-entry"  required="" />
                          <label class="">SECTION</label>                          
                          <select onchange="load_volume(this.value);" name="section"  class="input-block-level required-entry" required="" disabled="">
                                  <?php $sections = Section::find_all_by_location($session->location); if ($sections){  foreach($sections as $section){ ?>
                              <option value="<?php echo $section->id ?>" <?php if($section->id == $record->section){ echo "selected";}  ?>><?php  echo $section->no . "  - ". $section->name ?></option>
                                  <?php    } } ?>       
                          </select>                            
                          <label>VOLUME</label>
                          <input ''readonly=""'' type="text" name="volume" id="volume" value="<?php  echo $record->volume ?>" class="input-block-level required-entry"  required="" />
                          <label class="">LAST FOLIO NO.</label>
                          <input  type="text" id="lfn" value="<?php  echo $record->folio - 1 ?>" class="input-block-level required-entry"  required="" />
                          <label class="">FOLIO NO. FOR THIS RECORD</label>
                          <input  type="text" id="folio" name="folio" value="<?php  echo $record->folio ?>" class="input-block-level required-entry"  required="" />
                          <label class="">REMARKS</label>
                          <textarea name="remarks" class="input-block-level required-entry" required=""><?php  echo $record->remarks ?></textarea> 
                            </div>
                            <p>&nbsp;</p>
                            <div class="span8">
                                <input type="submit" class="btn btn-success btn-large"  name="submit" value="SAVE"/>
                                <input type="submit" class="btn btn-danger btn-large" value="CANCEL" name="cancel" />                        
                        </div>
                        </form>
                    </div><!--/row-->
                    </div><!--/row-->
            </div><!--/span-->
            </div><!--/row-->
        </div>
        <script type="text/javascript">
            
               function load_volume(section){
                 var volume = document.getElementById('volume');
                volume.value = "PLEASE WAIT...";
        if(window.XMLHttpRequest) {
                            mlhttp=new XMLHttpRequest();
                            }
                            else  {
                            mlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            mlhttp.onreadystatechange=function(){
                    if (mlhttp.readyState===4 && mlhttp.status===200){
//                        alert(mlhttp.responseText); 
            var datas = mlhttp.responseText.split("&");                          
                                                                       
        document.getElementById('volume').value= datas[0];

    
                    var myScripts = editdiv.getElementsByTagName("script");
                                    if (myScripts.length > 0) {
                                    eval(myScripts[0].innerHTML);
                                    }
                        }
                    };
                            mlhttp.open("GET","AjaxSnippets/objects.php?type=volume&section=" + section,true);
                            mlhttp.send();	
                            
        }
             </script>
<?php require_once 'layouts/footer.php';  