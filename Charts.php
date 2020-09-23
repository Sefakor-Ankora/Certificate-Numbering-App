<?php require_once 'includes/initialize.php';
$p =3;
            require_once './layouts/header.php';
?>
    </head>
    <body>
       <?php include_once 'layouts/navigation.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <?php  if (isset($message)){ echo $message;}  ?>

                    <div class="row-fluid">
                           <div class="hero-unit table table-bordered span12">
                                                   <div id="" class="">
                                                       <h4>NUMBERING CHART FOR  <?php  echo strtoupper($session->locname)  ?></h4> 
                    </div>          
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
                                  <table class="table  table-bordered table-striped">
                                        <tr>
                                            <?php $sections = Section::find_for_volume($volume->id,$session->location); if ($sections){
                                                    foreach ($sections as $section) {  ?>
                                            <td>
                                                <?php echo $section->no . "  -  ". $section->name  ?>                                            
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
