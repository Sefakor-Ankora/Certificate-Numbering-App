<?php require_once 'includes/initialize.php';
$volume = Volume::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if(isset($_POST['submit'])){                
                  $volume->no = trim($_POST['no']);
                $volume->district = trim($_POST['district']);
                $volume->user = $session->id;              
//                $volume->save();
               if($volume && $volume->save()){
                    //// SEND EMAIL FROM HERE
                $message = "<div class=\"alert alert-success\">Volume modified successfully</div>";  
               $session->message($message);
                        redirect_to("Volumes.php");
                } else {
                    $message = "<div class=\"alert alert-error\">An error occured!</div>";
                }
            }
                        
            if (filter_input(INPUT_POST, "cancel")){
                redirect_to("Volumes.php");
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
                               <div><h4>SETTINGS : Edit Volume </h4></div>
                               <p>&nbsp;</p>
                        <form id="newform" action="" method="POST">
                                        <div class="span6">
                          <label class="">VOLUME NO</label>
                          <input value="<?php echo $volume->no  ?>" type="number"  class="input-block-level required-entry "  placeholder="Input Volume No" title="Input Volume No" name="no" required readonly="" /> 
                          <label class="">DISTRICT CODE</label>
                          <input value="<?php echo $volume->district  ?>" type="text"  class="input-block-level required-entry "  placeholder="Input District" title="Input District Code" name="district" required  />
       
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