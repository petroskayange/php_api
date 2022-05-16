<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/parcel.php';
  include_once '../../models/Notification.php';

  if( 
        $_POST['weight'] &&
        $_POST['quantity'] &&
        $_POST['receiver_phone'] &&
        $_POST['sender_phone'] &&
        $_POST['name'] &&
        $_POST['to'] &&
        $_POST['from'] &&
        $_POST['description']
    ){

   

    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $parcel = new Parcel($db);
  $notification = new Notification($db);

  // Get raw posted data
  $referenceNumber = generateRandomString();

  $parcel->name = $_POST['name'];
  $parcel->weight = $_POST['weight'];
  $parcel->quantity = $_POST['quantity'];
  $parcel->referenceNumber = $referenceNumber;
  $parcel->receiver_phone = $_POST['receiver_phone']." & ". $_POST['sender_phone'];
  $parcel->description = $_POST['description'];
  $parcel->destination = "From ". $_POST['from']." To ". $_POST['to'];
  $parcel->amount = calculateAmount($_POST['weight'],$_POST['quantity'],$_POST['to'],$_POST['from']);

 

  // Create payment
    if( $parcel->create()) {

      $parcelID = $parcel->getParcelLastId();
      $notification->PackageStatus = $_POST['from'];
      $notification->parcelID = $parcelID;
      $notification->location = $_POST['to'];
      $notification->create();

      $output = array("data","plum");

      echo json_encode($output);

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
  function calculateAmount($weight,$quantity,$toText,$fromText){
    $districts = array("Mzuzu"   ,"Nkhotakota"   ,"Kasungu"   ,"Salima"   ,"Lilongwe"   ,"Mangochi"   ,"Blantyre");   
    $to = 0;
    $from = 0;
    $distance = 0;
    for ($i = 1; $i < count($districts) ; $i++) {
        if ($districts[$i] == $toText) {
            $to = $i;
        }
        if ($districts[$i] == $fromText) {
            $from = $i;
        }
    }
    if ($to > $from) {
        $distance = $to - $from;
    } else {
        $distance = $from - $to;
    }

    if($distance != 0)
      $distanceCost = $distance*300;
    else
        $distanceCost = 200;

    $total = ($quantity * $weight * 500) + $distanceCost;
   return $total;
    // return '500';
  }
  function console_log($message) {
    $STDERR = fopen("php://stderr", "w");
              fwrite($STDERR, "\n".$message."\n\n");
              fclose($STDERR);
}