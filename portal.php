<?php require_once 'includes/initialize.php';
            require_once 'layouts/header.php';
             include_once 'layouts/navigation-index.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                    <?php  if (isset($message)){ echo $message;}  ?>
                        <div class="hero-unit" style="margin: 0px auto 0px;width: 50%">
                                                    <h3 style="text-align: center">SYSTEM PORTAL  - LOCATION :<b class="alert alert-info"> <?php  echo ucwords($session->locname) ?> </b> </h3>
                                                    <hr />
                                                    <div style="text-align: center;overflow: auto;">                                                      
<!--                                                    <div class="portallink">
                                                        <a href="Records.php" id="records" class="" rel="popover" data-content="View Land registration records for a location add new and modify existing ones" data-original-title="Land Registration Records"> 
                                                            <img src="img/Records.png" class="portalimage" /><br /><br />
                                                        </a>
                                                        <a href="Records.php"><h4>VIEW REGISTRATION RECORDS</h4></a>
                                                    </div>
                                                    <div class="portallink">
                                                        <a href="Transfers.php" id="transfer" class="" rel="popover" data-content="View Land Transfer records, add new records" data-original-title="Transfer Records"> 
                                                            <img src="img/file-transfer-icon.png" class="portalimage" /><br /><br />
                                                        </a>
                                                        <a href="Transfers.php"><h4>LAND TRANSFER RECORDS</h4></a>
                                                    </div>
                                                    <div class="portallink">
                                                        <a href="Charts.php" id="chart" class="" rel="popover" data-content="View numbering chart for your current location" data-original-title="Numbering Chart"> 
                                                            <img src="img/flow_chart-.png" class="portalimage" /><br /><br />
                                                        </a>
                                                        <a href="Charts.php"><h4>NUMBERING CHART</h4></a>
                                                    </div>
                                                        
                                                    <div class="portallink">
                                                        <a href="Settings.php" id="settings" class="" rel="popover" data-content="View and modify system settings,users, sections, volumes...." data-original-title="System Settings"> 
                                                            <img src="img/settings.png" class="portalimage" /><br /><br />
                                                        </a>
                                                        <a href="Settings.php"><h4>SYSTEM SETTINGS</h4></a>
                                                    </div>
                                                    <div class="portallink">
                                                        <a href="MyPass.php" id="profile" class="" rel="popover" data-content="Change log in parameters....." data-original-title="Modify Password"> 
                                                            <img src="img/profile.png" class="portalimage" /><br /><br />
                                                        </a>
                                                        <a href="MyPass.php"><h4>CHANGE YOUR PASSWORD</h4></a>
                                                    </div>
                                                    <div class="portallink">
                                                        <a href="Logout.php" id="logout" class="" rel="popover" data-content="Logout of system" data-original-title="Logout "> 
                                                            <img src="img/Logout-01.png" class="portalimage" /><br /><br />
                                                        </a>
                                                        <a href="Logout.php"><h4>LOGOUT</h4></a>
                                                    </div>-->
<a href="Records.php" class="btn btn-large btn-info">VIEW ALL RECORDS</a><br /><hr />
<a href="Records-Add.php" class="btn btn-large btn-inverse">NEW LAND RECORD</a><br /><br />
<a href="Records-Add2.php" class="btn btn-large btn-inverse">NEW TRANSFER RECORD</a><br /><br />
<a href="Records-Add1.php" class="btn btn-large btn-inverse">NEW CADASTRAL RECORD</a><br /> <hr />
<a href="Reports.php" class="btn btn-large btn-success">CREATE REPORT / VIEW</a><br /><hr />
<?php if ($session->role != "officer"){  ?><a href="Settings.php" class="btn btn-large btn-warning" onclick="return confirm('Changes made here may affect existing records!!\nContinue?')">SYSTEM SETTINGS</a><br /><br /><?php  } ?>
<a href="MyPass.php" class="btn btn-large btn-warning" onclick="return confirm('You are about to Change your Password\nContinue?')">CHANGE YOUR PASSWORD</a><br /> <hr />
<a href="Logout.php" class="btn btn-large btn-danger" onclick="return confirm('Logout of system?\n All unsaved progress will be lost')">LOGOUT</a>
                                                    </div>
            </div>  
            </div>
        </div>
<?php require_once 'layouts/footer.php';
