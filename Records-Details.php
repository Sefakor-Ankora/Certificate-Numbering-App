<?php require_once 'includes/initialize.php';
            $p =1;            
            require_once './layouts/header.php';         
            $record = Record::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
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
                        <h4>View Details for  Record </h4> 
                        <p>&nbsp;</p>
                    </div>
                        <form id="newform" action="" method="POST">
                             <div class="span6">
                            <div>
                                <h4 class='label label-important'>RECORD TYPE.</h4>
                                <h4 class="alert alert-heading"><?php  echo ucwords($record->type) ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>CERTIFICATE NO.</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->cno ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>PROPRIETOR.</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->prop ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>AMOUNT PAID.</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->amtpaid ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>ISSUE DATE.</h4>
                                <h4 class="alert alert-heading"><?php  echo datetime_to_text2($record->doi) ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>LODGEMENT DATE.</h4>
                                <h4 class="alert alert-heading"><?php  echo datetime_to_text2($record->dol) ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>LODGEMENT NO.</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->lno ?></h4>
                            </div>
                            <div>
                                <h4 class='label label-important'>PARCEL NO.</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->pno ?></h4>
                            </div>
                        </div>
                            <div class="span6">
                            <div>
                                <h4 class='label label-important'>PLAN NO</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->plno ?></h4>
                            </div>                                
                            <div>
                                <h4 class='label label-important'>SECTION</h4>
                                <h4 class="alert alert-heading"><?php 
                                if ($record->section != "" || $record->section !=0){
                                    $section = Section::find_by_id($record->section);
                                    if ($section){
                                        echo $section->no . "  - ". $section->name;
                                    } else{
                                        echo "N/A";
                                    }
                                } else {
                                    echo "N/A";
                                }                                
                                        ?></h4>
                            </div>                        
                            <div>
                                <h4 class='label label-important'>VOLUME</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->volume ?></h4>
                            </div>                 
                            <div>
                                <h4 class='label label-important'>FOLIO NO. FOR THIS RECORD</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->folio  ?></h4>
                            </div>                 
                            <div>
                                <h4 class='label label-important'>REMARKS</h4>
                                <h4 class="alert alert-heading"><?php  echo $record->remarks ?></h4>
                            </div>                 
                            <div>
                                <h4 class='label label-important'>DATE CREATED</h4>
                                <h4 class="alert alert-heading"><?php  echo datetime_to_text1($record->created) ?></h4>
                            </div>                 
                            <div>
                                <h4 class='label label-important'>CREATED BY</h4>
                                <h4 class="alert alert-heading"><?php 
                                        $user = User::find_by_id($record->section);
                                    if ($user){
                                        echo  $user->name;
                                    } else{
                                        echo "N/A";
                                    }
                                        ?></h4>
                                  <div>
                                <h4 class='label label-info'>OPTIONS</h4>
                                <h4 class="alert alert-info">
                                    <?php if($record->type == "cadastral"){  ?>
                                    <a href="Records-Edit1.php?id=<?php echo base64_encode($record->id)  ?>&d=1" class="btn btn-warning btn-large">EDIT</a>
                                    <?php  } else if ($record->type == "transfer"){ ?>
                                    <a href="Records-Edit2.php?id=<?php echo base64_encode($record->id)  ?>&d=1" class="btn btn-warning btn-large">EDIT</a>
                                    <?php  } else if ($record->type == "record"){ ?>
                                    <a href="Records-Edit.php?id=<?php echo base64_encode($record->id)  ?>&d=1" class="btn btn-warning btn-large">EDIT</a>
                                    <?php  } ?>
                                    <a href="Delete.php?id=<?php  echo base64_encode($record->id) ?>&s=record"onclick="return confirm('Are you sure?')" class="btn btn-large btn-danger">DELETE</a>
                                </h4>
                            </div>    
                            </div>                 
                            </div>
                               
                    </div><!--/row-->
                    </div><!--/row-->
            </div><!--/span-->
            </div><!--/row-->
        </div>
<?php require_once 'layouts/footer.php';  