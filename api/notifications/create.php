<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Notification.php';

  if( 
      $_POST['parcelID'] && 
      $_POST['location'] ){
    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $notification = new Notification($db);

  // Get raw posted data
 
  $notification->PackageStatus = null;
  $notification->parcelID = $_POST['parcelID'];
  $notification->location = $_POST['location'];

  // Create payment
    if($notification->create()) {
      echo json_encode(
        array('message' => 'Notification  Created')
      );
    }else{
        echo json_encode(
            array('message' => 'Notification Not Created')
          );
          header('HTTP/1.1 400 Fail to create payment', true, 400);
    }
}else
header('HTTP/1.1 422 Invalid Data', true, 422);

function console_log($message) {
  $STDERR = fopen("php://stderr", "w");
            fwrite($STDERR, "\n".$message."\n\n");
            fclose($STDERR);
}
    ?>