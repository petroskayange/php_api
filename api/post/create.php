<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Payment.php';
  include_once '../../models/parcel.php';
  include_once '../sms/SendSMS.php';

  console_log($_POST['weight'] ."&&". 
  $_POST['quantity'] ."&&". 
  $_POST['receiver_phone'] ."&&". 
  $_POST['sender_phone'] ."&&". 
  $_POST['userID'] ."&&". 
  $_POST['name'] ."&&". 
  $_POST['amount'] ."&&". 
  $_POST['to'] ."&&". 
  $_POST['from'] ."&&". 
  $_POST['paymentAt'] ."&&". 
  $_POST['paymentMethod'] ."&&". 
  $_POST['description']);
  
  if( $_POST['weight'] && 
      $_POST['quantity'] && 
      $_POST['receiver_phone'] && 
      $_POST['sender_phone'] && 
      $_POST['userID'] && 
      $_POST['name'] && 
      $_POST['amount'] && 
      $_POST['to'] && 
      $_POST['from'] && 
      $_POST['paymentAt'] && 
      $_POST['paymentMethod'] && 
      $_POST['description']){

   

    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $payment = new Payment($db);
  $parcel = new Parcel($db);

  if($_POST['paymentMethod'] == "Cash Payment" )
    $status = "Cleared";
  else
    $status = null;
  // Get raw posted data
  $referenceNumber = generateRandomString();
  $payment->referenceNumber = $referenceNumber;
  $payment->type =  calculateAmount($_POST['weight'] ,$_POST['quantity']);
  $payment->userID = $_POST['userID'];
  $payment->paymentMethod = $_POST['paymentMethod'];
  $payment->paymentAt = $_POST['paymentAt'];
  $payment->date = date('m/d/Y h:i:s a', time());
  $payment->amount = $_POST['amount'];
  $payment->status = $status;

  $parcel->name = $_POST['name'];
  $parcel->weight = $_POST['weight'];
  $parcel->quantity = $_POST['quantity'];
  $parcel->referenceNumber = $referenceNumber;
  $parcel->receiver_phone = $_POST['receiver_phone'];
  $parcel->description = $_POST['description'];
  $parcel->destination = "From ". $_POST['from']." To ". $_POST['to'];

  // Create payment
    if($payment->create() && $parcel->create()) {
      $sendSMS = new SendSMS();
      $message = "Reference number: ".$referenceNumber.
      ", Product Name: ".$_POST['name'].
      ", amount: ".$_POST['amount'].
      ", Payment at: ".$_POST['paymentAt'].
      ", Payment method: ".$_POST['paymentMethod'];


      $sendSMS->submitSMS($message,$_POST['receiver_phone'],$_POST['sender_phone'],"1");
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
  function calculateAmount($weight,$quantity){
   return $weight * $quantity * 500;
    // return '500';
  }
  function console_log($message) {
    $STDERR = fopen("php://stderr", "w");
              fwrite($STDERR, "\n".$message."\n\n");
              fclose($STDERR);
}