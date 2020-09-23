<?php require_once 'includes/initialize.php';
$p =2;
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
                           <div class="hero-unit">
                               <div id="" class="">
                                   <h4>CREATE REPORTS / VIEW</h4>
                        <table class="table table-bordered" style="width: 100%">
                            <thead style="text-align: center">
                                <tr>
                                    <th> DATE TYPE:</th>
                                    <th> START DATE</th>
                                    <th> END DATE</th>
                                    <th> RECORD TYPE</th>
                                    <th></th>
                                </tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="datetype" class="input-block-level">
                                            <option value="created">Date Created</option>
                                            <option value="doi">Issue Date</option>
                                            <option value="dol">Lodgement Date</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" id="datepicker" class="input-block-level" />
                                    </td>
                                    <td>
                                        <input type="date" id="datepicker1" class="input-block-level" />
                                    </td>
                                    <td>
                                        <select id="type" class="input-block-level">
                                            <option value="">All Records</option>
                                            <option value="record">Land Records</option>
                                            <option value="cadastral">Cadastral Records</option>
                                            <option value="transfer">Transfer Records</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary input-block-level" onclick="report();">PREVIEW</button></td>
                                </tr>
                            </tbody>
                            
                        </table>                          
                    </div>
                 
                        </div>
                        <div class="hero-unit" id="results">
                            
                        </div>
                    </div><!--/row-->
                 
            </div><!--/span-->
            </div><!--/row-->
        </div>
            <script type="text/javascript">
            
             function report(){
                var datetype = document.getElementById('datetype').value;
        var res = document.getElementById('results');
        var sdate  = document.getElementById('datepicker').value;
        var edate = document.getElementById('datepicker1').value;
        var type = document.getElementById('type').value;
        res.innerHTML = "<img src=\"img/loader.gif\" width='40' height='40'  />PLEASE WAIT...";
                if(window.XMLHttpRequest)
                {
                mlhttp=new XMLHttpRequest();
                }
                else
                {
                mlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                mlhttp.onreadystatechange=function()
                {
        if (mlhttp.readyState===4 && mlhttp.status===200){
        res.innerHTML = mlhttp.responseText;
var myScripts = editdiv.getElementsByTagName("script");
			if (myScripts.length > 0) {
                            eval(myScripts[0].innerHTML);
			}
            }
        };
                mlhttp.open("GET","AjaxSnippets/objects.php?type=report&rtype=" + type +"&sdate="+ sdate+"&edate="+edate + "&datetype=" + datetype,true);
                mlhttp.send();	
        }
             </script>
<?php require_once 'layouts/footer.php'; 
