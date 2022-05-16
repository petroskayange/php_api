<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/Price.php';

  if( 
      $_POST['id'] && 
      $_POST['name'] ){
    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $Price = new Price($db);

  // Get raw posted data
 
  $Price->PackageStatus = null;
  $Price->parcelID = $_POST['parcelID'];
  $Price->location = $_POST['location'];

  // Create payment
    if($Price->create()) {
      echo json_encode(
        array('message' => 'Price  Created')
      );
    }else{
        echo json_encode(
            array('message' => 'Price Not Created')
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