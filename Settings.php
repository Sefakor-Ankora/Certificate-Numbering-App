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

                    <div class="row-fluid" >
                           <div class="hero-unit table table-bordered span12" style="height: 500px">
                                                   <div id="" class="">
                        <h4>SETTINGS</h4> 
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