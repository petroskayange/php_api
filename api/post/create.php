<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Payment.php';
  include_once '../../models/parcel.php';
  include_once '../../models/Notification.php';
  include_once '../sms/SendSMS.php';


  
  if(  
      $_POST['referenceNumber'] && 
      $_POST['paymentAt'] && 
      $_POST['paymentMethod'] 
      ){

   

    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $payment = new Payment($db);
  $parcel = new Parcel($db);
  $notification = new Notification($db);

  if($_POST['paymentMethod'] == "Cash Payment" && $_POST['paymentAt'] != "drop off")
    $status = "Cleared";
  else
    $status = "Not Cleared";
  // Get raw posted data
  $payment->referenceNumber = $_POST['referenceNumber'];
  $payment->type =  'null';
  $payment->userID = 'null';
  $payment->paymentMethod = $_POST['paymentMethod'];
  $payment->paymentAt = $_POST['paymentAt'];
  $payment->date = date('m/d/Y h:i:s a', time());
  $payment->amount = "null";
  $payment->status = $status;

  // Create payment
    if($payment->create() && $parcel->create()) {
      $sendSMS = new SendSMS();
      $sendSMS->submitSMS($status,$_POST['referenceNumber']);
      echo json_encode(
        array('message' => 'Post Created')
      );
    } else {

      echo json_encode(
        array('message' => 'Post Not Created')
      );
      header('HTTP/1.1 400 Fail to create payment', true, 400);
    }
  }else
  header('HTTP/1.1 422 Invalid Data', true, 422);

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function console_log($message) {
    $STDERR = fopen("php://stderr", "w");
              fwrite($STDERR, "\n".$message."\n\n");
              fclose($STDERR);
}