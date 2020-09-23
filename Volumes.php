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
                       <h4>SETTINGS : Volumes </h4>
                                                                        <form>
      <input  name="filter" onkeyup="filterTable(this, sf)" placeholder="Enter Search Value" type="text" autofocus />
    </form>  
                        <table class="table-bordered table table-striped" id="sf">
                              <thead style="position: relative">
                              <th>Volume No.</th>                              
                              <th>Location</th>
                              <th>No. of Sections</th>
                              <th>District</th>
                              <th>Actions</th>
                          </thead>
                          <?php 
                          $volumes = Volume::find_all_by_location($session->location);
                            if($volumes){
                                  foreach ($volumes  as $volume){  
                              ?>
                          <tr>                                                              
                                <td><?php  echo $volume->no ?></td>
                                <td><?php  echo "Greater Accra" ?></td>
                                <td><?php  echo Section::count_all_for_volume($volume->id,$session->location) ?></td>
                                <td><?php  echo $volume->district ?></td>
                                <td><a href="Volumes-Edit.php?id=<?php echo base64_encode($volume->id)  ?>"><img title="View / Edit" src="img/edit.jpg" width="15px" height="15px" /></a> &nbsp;&nbsp;  <a href="Delete.php?id=<?php  echo base64_encode($volume->id) ?>&s=volume"onclick="return confirm('Are you sure?')" title="Remove"><img src="img/remove.png" width="15px" height="15px" /></a> </td>
                            </tr>
                                  <?php  }} else { ?>
                            <tr>
                                <td colspan="7"><div class="alert-info">NO VOLUME FOUND. <a href="Volumes-Add.php">Add </a> new Volume</div></td>
                            </tr>
                         <?php  } ?>
                        </table>
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