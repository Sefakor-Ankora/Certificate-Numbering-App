<?php require_once("includes/initialize.php"); ?>
<?php	
if ( $session->logout()){
    redirect_to("index.php?message=<div class=\"alert-info\">You have been logged out.</div>");
}