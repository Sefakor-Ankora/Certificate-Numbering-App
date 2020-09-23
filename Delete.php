<?php
    require_once 'includes/initialize.php';
    if(!filter_input(INPUT_GET, "id")){
        $session->message("<h4 class=\"alert alert-error\">An Error Occured!</h4>");
        redirect_to($session->startpage);
    }
    switch (filter_input(INPUT_GET, "s")) {
        //USER
    case "user":
         $user = User::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if($user && $user->delete()){

           $session->message("<h4 class=\"alert alert-success\">User Removed successfully</h4>");
        redirect_to("Users.php");
    }else {
        $session->message("<h4 class=\"alert alert-error\">User Not Removed!</h4>");
        redirect_to("Users.php");
    }

            break;
    case "volume":
            $volume = Volume::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if($volume && $volume->delete()){
           $session->message("<h4 class=\"alert alert-success\">Volume Removed successfully</h4>");
        redirect_to("Volumes.php");
    }else {
        $session->message("<h4 class=\"alert alert-error\">Volume Not Removed!</h4>");
        redirect_to("Volumes.php");
    }
        break;
    case "section":
         $section = Section::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
        if($section  && $section->delete()){
            $session->message("<h4 class=\"alert alert-success\">Section Removed successfully</h4>");
        } else {
        $session->message("<h4 class=\"alert alert-error\">Section Not Removed!</h4>");    
        }
        redirect_to("Sections.php");
        break;
    case "record":
        $record = Record::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
        if($record && $record->delete()){
             $session->message("<h4 class=\"alert alert-success\">Record Removed successfully</h4>");
        } else {
        $session->message("<h4 class=\"alert alert-error\">Record Not Removed!</h4>");    
        }
        redirect_to("Records.php");        
        break;
    case "location":
        $location = Location::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
        if($location && $location->delete()){
                  $session->message("<h4 class=\"alert alert-success\">Location Removed successfully</h4>");
        } else {
        $session->message("<h4 class=\"alert alert-error\">Location Not Removed!</h4>");    
        }
        redirect_to("Location.php");        
        break;
    case "postmodel":
   
    case "transfer":
                $transfer = Transfer::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if($transfer && $transfer->delete()){
           $session->message("<h4 class=\"alert alert-success\">Transfer Removed successfully</h4>");
        redirect_to("Transfers.php");
    }else {
        $session->message("<h4 class=\"alert alert-error\">An Error Occured!</h4>");
        redirect_to("Transfers.php");
        }
        break;
    case "phase":
                $phase = Phase::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
    if($phase && $phase->delete()){
           $session->message("<h4 class=\"alert alert-success\">{$phase->name} Removed successfully</h4>");
        redirect_to("Tasks-Phases.php");
    }else {
        $session->message("<h4 class=\"alert alert-error\">{$phase->name} Not Removed!</h4>");
        redirect_to("Tasks-Phases.php");
        }
        break;
    case "taskticket":
                $taskticket = TaskTicket::find_by_id(base64_decode(filter_input(INPUT_GET, "taskticket")));
    if($taskticket && $taskticket->delete()){
           $session->message("<h4 class=\"alert alert-success\">Record Removed successfully</h4>");
    }else {
        $session->message("<h4 class=\"alert alert-error\">Record Not Removed!</h4>");
        }
                    redirect_to("Tasks-Details.php?id=". filter_input(INPUT_GET, "id")."&phase=". filter_input(INPUT_GET, "phase"));
        break;
    case "taskitem":
           $itemuse = ItemUse::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));
            $item = Item::find_by_id($itemuse->itemid);
            $item->qty += 1;
              if($itemuse->delete() && $item->save()){
           $session->message("<h4 class=\"alert alert-success\">Inventory Removed successfully</h4>");
            }else {
        $session->message("<h4 class=\"alert alert-error\">Record Not Removed!</h4>");
            }
                    redirect_to("Tasks-Tickets-Details.php?task=". filter_input(INPUT_GET, "task")."&phase=". filter_input(INPUT_GET, "phase")."&taskticket=".  filter_input(INPUT_GET, "taskticket"));
        break;
    case "swap":
           $swap = SwapRequest::find_by_id(base64_decode(filter_input(INPUT_GET, "id")));                       
              if($swap && $swap->delete()){
           $session->message("<h4 class=\"alert alert-success\">Swap Record removed successfully</h4>");
            }else {
        $session->message("<h4 class=\"alert alert-error\">Record Not Removed!</h4>");
            }               
            if(filter_input(INPUT_GET, "d")==0){
                redirect_to("Swap-Requests.php");
            } else if (filter_input(INPUT_GET, "d")==1){
                redirect_to("Swap-Requests-Batch-Details.php?swapbatch=".base64_encode($swap->batchno));
            }
                redirect_to("Swap-Requests.php");            
            break;
    case "swapbatch":
           $swaps = SwapRequest::find_by_batchno(base64_decode(filter_input(INPUT_GET, "swapbatch")));                       
        if($swaps){
            foreach ($swaps as $swap) {
                $swap->delete();
            }
            $session->message("<h4 class=\"alert alert-success\">Swap Batch removed successfully</h4>");
        } else{
            $session->message("<h4 class=\"alert alert-error\">Batch Not Removed!</h4>");
        }      
                redirect_to("Swap-Requests.php");            
            break;
    default:
        break;
}
   