<?php require_once 'includes/initialize.php';
$p =1;
            require_once './layouts/header.php';
            
            //         The current page number = $current_page
        $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
        // no of records per page = $per_page
        $per_page = 500;
        // total record count = $total_count
        $total_count = Record::count_all_for_location($session->location);
//        $icons = Photograph::find_all();
        $pagination = new Pagination($page, $per_page, $total_count);
        $sql = "SELECT * FROM record WHERE deleted = 0 AND location = '{$session->location}' ORDER BY id DESC ";
        $sql .= " LIMIT {$per_page}";
        $sql .= " OFFSET {$pagination->offset()}";
        $records = Record::find_by_sql($sql);
?>
    </head>
    <body>
       <?php include_once 'layouts/navigation.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">

                <div class="span12">
                    <?php  if (isset($message)){ echo $message;}  ?>

                    <div class="row-fluid">
                           <div class="hero-unit span12">
                                      <div class="label label-info" style="font-size: 16px"> <?php $from = (($page -1)* $per_page )+1;  $to = $from  + ($per_page - 1);  
        if ($to > $total_count): $to = $total_count;  endif;
      echo "SHOWING  FROM <b>{$from}</b> TO  <b>{$to}</b>   OF   <b>{$total_count }</b>  RECORDS"; ?>                                       
                                   
    </div>               
    <?php
            if ($pagination->total_pages() > 1) {
                echo " <ul class='pagination'>";
                if ($pagination->has_previous_page()) {
                    echo "<li class= 'previous' ><a style=\"color:blue\" href=\"Records.php?page=";
                    echo $pagination->previous_page();
                    echo "\"> Previous</a> </li>";
                }

                for ($i = 1; $i <= $pagination->total_pages(); $i++) {
                    if ($i == $page) {
                        echo " <li class=\"disabled\"><a>{$i}</a></li> ";
                    } else {
                        echo "<li> <a style=\"color:blue\" href=\"Records.php?page={$i}\">{$i}</a></li> ";
                    }
                }

                if ($pagination->has_next_page()) {
                    echo " <li class =\"next\"><a style=\"color:blue\" class=\"\"  href=\"Records.php?page=";
                    echo $pagination->next_page();
                    echo "\">Next</a> </li>";
                }
                echo "</ul>";
            }
            ?>
                               <div id="" class="">
                        <h4>LAND REGISTRATION RECORDS - <?php echo count($records) ?>  
                            -   <a href="Records-Add.php">ADD NEW RECORD</a> &parallel;
                            <a href="Records-Add1.php">ADD NEW CADASTRAL RECORD</a>    &parallel;
                            <a href="Records-Add1.php">ADD NEW TRANSFER RECORD</a>    
                        </h4> 
        </div>
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <thead style="text-align: center">
                                <tr>
                                    <th rowspan='2' > CERTIFICATE NO:</th>
                                    <th rowspan='2' > PROPRIETOR</th>
                                    <th rowspan='2' > AMT. PAID</th>
                                    <th rowspan='2' >ISSUE DATE</th>
                                    <th rowspan='2' > LODGEMENT DATE</th>
                                    <th rowspan='2' > LODGEMENT NO.</th>
                                    <th rowspan='2' > PARCEL NO.</th>
                                    <th rowspan='2' > SECTION</th>
                                    <th rowspan='2' > PLAN NO.</th>
                                    <th colspan="2"> REGISTER</th>
                                    <th rowspan='2' > REMARKS</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th>VOLUME</th>
                                    <th>FOLIO</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php  if ($records){
                                    foreach ($records as $record): ?>
                                <tr>
                                    <td><a href="Records-Details.php?id=<?php  echo base64_encode($record->id) ?>"><b><?php  echo strtoupper($record->cno) ?></b></a></td>
                                    <td><?php  echo strtoupper($record->prop)  ?></td>                                    
                                    <td><?php  echo number_format($record->amtpaid,2, ".",'')  ?></td>
                                    <td><?php  echo datetime_to_text2($record->doi) ?></td>
                                    <td><?php  echo datetime_to_text2($record->dol) ?></td>
                                    <td><?php  echo strtoupper($record->lno)  ?></td>
                                    <td><?php  if ($record->pno != ""){ echo strtoupper($record->pno); } else { echo "--------";}  ?></td>
                                    <td><?php if($record->section != 0){  $section = Section::find_by_id($record->section); echo $section->no . " - ". $section->name; }else { echo "--------";}  ?></td>
                                    <td><?php  echo $record->plno ?></td>
                                    <td><?php  echo $record->volume  ?></td>
                                    <td><?php  echo $record->folio ?></td>
                                    <td><?php  echo $record->remarks  ?></td>
                                    <td>
                                        <?php if($record->type == "cadastral"){  ?>
                                        <a href="Records-Edit1.php?id=<?php echo base64_encode($record->id)  ?>&d=1"><img title="View / Edit Record Details" src="img/edit.jpg" width="15px" height="15px" /></a>
                                        <?php  } else if ($record->type == "transfer"){ ?>
                                        <a href="Records-Edit2.php?id=<?php echo base64_encode($record->id)  ?>&d=1"><img title="View / Edit Record Details" src="img/edit.jpg" width="15px" height="15px" /></a>
                                        <?php  } else if ($record->type == "record"){ ?>
                                        <a href="Records-Edit.php?id=<?php echo base64_encode($record->id)  ?>&d=1"><img title="View / Edit Record Details" src="img/edit.jpg" width="15px" height="15px" /></a>
                                        <?php  } ?>
                                        &nbsp;&nbsp;  <a href="Delete.php?id=<?php  echo base64_encode($record->id) ?>&s=record"onclick="return confirm('Are you sure?')" ><img src="img/remove.png" width="15px" height="15px" /></a> </td>
                                </tr>
                                <?php endforeach;   } else {
                                    echo "<td colspan='13' class='alert alert-info'><h4>NO RECORDS FOUND</h4></td>";
                                } ?>
                            </tbody>
                        </table>                          
                    </div>
                 
                        </div>
                    </div><!--/row-->
                 
            </div><!--/span-->
            </div><!--/row-->
        </div>
<?php require_once 'layouts/footer.php'; 
