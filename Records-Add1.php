<?php require_once 'includes/initialize.php';
            $p =1;
            require_once './layouts/header.php';
                        $location = Location::find_by_id($session->location);
            $prefix = $location->prefix;
            $llno = Record::find_last_certno($session->location);            
            if ($llno){                
                $lastno = (int) substr($llno->cno, strlen($prefix));
                $certno = $prefix . ($lastno +1);
                $certno1 = $prefix.$lastno;
            } else{
                $certno = $prefix.$location->sno;
                $certno1 = $prefix.($location->sno  - 1 );                
            }
            if(isset($_POST['submit'])){
                $record = new Record();
                $record->cno  = $certno;
                $record->prop  = trim(filter_input(INPUT_POST, "prop"));
                $record->amtpaid  = trim(filter_input(INPUT_POST, "amtpaid"));
                $record->doi  = trim(filter_input(INPUT_POST, "doi"));
                $record->type = "cadastral";
                $record->dol  = trim(filter_input(INPUT_POST, "dol"));
                $record->lno  = trim(filter_input(INPUT_POST, "lno"));
                $record->pno  = trim(filter_input(INPUT_POST, "pno"));
                $record->plno  = trim(filter_input(INPUT_POST, "plno"));
                $record->volume  = trim(filter_input(INPUT_POST, "volume"));
                $record->section = trim(filter_input(INPUT_POST, "section"));
                $record->folio = trim(filter_input(INPUT_POST, "folio"));
                $lrecord = Record::find_last_foliono($record->volume, $session->location);
             //   if($lrecord){
               //     $record->folio =  $lrecord->folio + 1;
//                } else {
  //                  $record->folio = 1;
    //            }
                $record->remarks = trim(filter_input(INPUT_POST, "remarks"));
                $record->user = $session->id;
                $record->location = $session->location;
                $record->created = strftime("%Y-%m-%d %H:%M:%S", time());
                $check = Record::check_existing($record->cno,0,$session->location);
            if ($check){
                    $message = "<div class=\"alert alert-error\">Certificate NO. already exists!</div>";
                } else if($record && $record->save()){
                    // if we were able to create the lmc and save it we 
                    // do the following
              $message = "<div class=\"alert alert-success\">Cadastral Record saved successfully<br />Volume No is <b>{$record->volume}</b><br />Folio No is <b>{$record->folio}</b></div>";  
               $session->message($message);
                    if ($_POST['action'] == 1 ){                        
                        redirect_to("Records.php");
                    } else if ($_POST['action'] == 2 ){                        
                        redirect_to("Records-Add1.php?action={$_POST['action']}");
                    } else if ($_POST['action'] == 3 ){
                        redirect_to("Records-Details.php?id=".  base64_encode($record->id));
                    }
                } else {
                    $message = "<div class=\"alert  alert-error\">An error occured!</div>";
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
                        <h4>New Cadastral Record for  <?php  echo $session->locname  ?></h4> 
                        <p>&nbsp;</p>
                    </div>
                        <form id="newform" action="" method="POST">
                             <div class="span6">
                          <label class="">PREVIOUS CERTIFICATE NO.</label>
                          <input type="text" readonly="" value="<?php  echo $certno1 ?>" class="input-block-level "/>
                          <label class="">CERTIFICATE NO.</label>
                          <input type="text" name="cno" value="<?php  echo $certno ?>" class="input-block-level required-entry"  required="" />
                          <label class="">PROPRIETOR.</label>
                          <input type="text" name="prop" value="" class="input-block-level required-entry"  required="" />
                          <label class="">AMOUNT PAID</label>
                          <input type="text" name="amtpaid" value="" class="input-block-level required-entry"  required="" />
                          <label class="">ISSUE DATE</label>
                          <input type="date" id="datepicker" name="doi" value="" class="input-block-level required-entry"  required="" />
                          <label class="">LODGEMENT DATE</label>
                          <input type="date" id="datepicker1" name="dol" value="" class="input-block-level required-entry"  required="" />
                          <label class="">LODGEMENT NO.</label>
                          <input type="text" name="lno" value="" class="input-block-level required-entry"  required="" />
                            <label class="">PARCEL NO.</label>
                            <input type="text" name="pno" value="" class="input-block-level" readonly="" />
                        </div>
                            <div class="span6">
                            <label class="">PLAN NO.</label>
                          <input type="text" name="plno" value="" class="input-block-level required-entry"  required="" />
                          <label class="">VOLUME</label>
                          <select onchange="loadfolio(this.value);" name="volume"  class="input-block-level required-entry" required="">
                              <option value="">PLEASE SELECT</option>
                              <?php  
                                        for ($i=1; $i <= 17; $i++){
                                            echo "<option value=\"0".$i."\">0". $i ."</option>";
                                        }
                              ?>                       
                          </select>                          
                            <label class="">SECTION</label>
                            <input type="text" name="section" value="" class="input-block-level" readonly="" />
                          <label class="">LAST FOLIO NO.</label>
                          <input readonly="" type="text" id="lfn" value="" class="input-block-level required-entry"  required="" />
                          <label class="">FOLIO NO. FOR THIS RECORD</label>
                          <input  type="text" id="folio" name="folio" value="" class="input-block-level required-entry"  required="" />
                          <label class="">REMARKS</label>
                          <textarea name="remarks" class="input-block-level required-entry" required=""></textarea>
                             <label class="">ACTION</label>
                       <select name="action" class="input-block-level">
                            <option value="1" <?php if (isset($action) && $action==1){ echo "selected";}  ?>>SAVE AND VIEW ALL RECORDS</option>
                            <option value="2" <?php if (isset($action) && $action==2){ echo "selected";}  ?>>SAVE AND ADD NEW</option>
                            <option value="3" <?php if (isset($action) && $action==3){ echo "selected";}  ?>>SAVE AND ADD DETAILS</option>
                        </select>  
                            </div>
                            <p>&nbsp;</p>
                            <div class="span8">
                            <input type="submit" class="btn btn-success btn-large"  name="submit" value="SAVE"/>  <input type="reset" class="btn btn-warning btn-large" value="CLEAR FORM" />
                        </div>
                        </form>
                    </div><!--/row-->
                    </div><!--/row-->
            </div><!--/span-->
            </div><!--/row-->
        </div>
        <script type="text/javascript">
            
             function loadfolio(district){
        document.getElementById('lfn').value = "Please Wait";
        document.getElementById('folio').value = "Please Wait";
        document.getElementById('details').innerHTM = "<img src=\"img/loader.gif\" width='25' height='25'  />PLEASE WAIT...";
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
                                                                               
        document.getElementById('lfn').value = datas[0];
        document.getElementById('folio').value = datas[1];
        document.getElementById('details').innerHTML = datas[2];

    
                    var myScripts = editdiv.getElementsByTagName("script");
                                    if (myScripts.length > 0) {
                                    eval(myScripts[0].innerHTML);
                                    }
                        }
                    };
                            mlhttp.open("GET","AjaxSnippets/objects.php?type=districtfolio&district=" + district,true);
                            mlhttp.send();	
                            
        }
             </script>
<?php require_once 'layouts/footer.php';  
