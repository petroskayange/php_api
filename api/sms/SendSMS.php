<?php 
include_once '../../config/Database.php';
include_once '../../models/parcel.php';
class SendSMS{

    function submitSMS($status,$referenceNumber){
        
        // Instantiate DB & connect
        $database = new Database();
        $db = $database->connect();
        $message_id = 1;

        // Instantiate blog post object
        $Parcel = new Parcel($db);

        $Parcel->referenceNumber = $referenceNumber;
        // Blog Parcel query
        $Parcel->read_single();

        $amount  = $Parcel->amount;
        $phones  = explode("&amp;", $Parcel->receiver_phone);;

        $message = "Reference number: ".$referenceNumber.
        ", Product Name: ".$Parcel->name.
        ", Amount: ".$amount.
        ", Status: ".$status;
        // $message,$receiverPhone,$senderPhone,$message_id
        $myObj = new stdClass();
        $myObj->message = $message;
        $myObj->phone = $phones[1];
        $myObj->message_id = $message_id;

        $myObj2 = new stdClass();
        $myObj2->message = $message;
        $myObj2->phone = $phones[0];
        $myObj2->message_id = $message_id;
        
        $myJSON = array($myObj,$myObj2);
        return $myJSON;
       
    }

}

?>