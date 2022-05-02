<?php 

class SendSMS{

    function submitSMS($status,$referenceNumber){

        $message = "Reference number: ".$referenceNumber.
        ", Product Name: ".$_POST['name'].
        ", Amount: ".$amount.
        ", Status: ".$status;
        // $message,$receiverPhone,$senderPhone,$message_id

        $myObj = new stdClass();
        $myObj->message = $message;
        $myObj->phone = $receiverPhone;
        $myObj->message_id = $message_id;

        $myObj2 = new stdClass();
        $myObj2->message = $message;
        $myObj2->phone = $senderPhone;
        $myObj2->message_id = $message_id;

        $myJSON = json_encode(array($myObj,$myObj2));
        $opts = array(
            'http' =>array(
                'timeout' => 30,
                'method' => 'POST',
                'header' => "Content-type: multipart/form-data\r\n".
                "User-Agent:MyAgent/1.0\r\n".
                "Connection: keep-alive\r\n".
                "Content-Disposition:form-data; name='json' \r\n".
                $myJSON
            )
        );
        
        $context = stream_context_create($opts);
        $url = 'http://192.168.1.160:3003/';        
        $result = file_get_contents($url, false, $context);
        echo $result;
    }

}

?>