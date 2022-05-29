<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/branch.php';

  
  if( $_POST['location'] &&  $_POST['id'] ){
    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $branch = new Branch($db);

  // Get raw posted data
  $branch->name = $_POST['location'];
  $branch->id = $_POST['id'];

  if($branch->update()){
    echo json_encode("Successfully registered");
  }else
  header('HTTP/1.1 400 Fail to create payment', true, 400);
  
 
}else
header('HTTP/1.1 422 Invalid Data', true, 422);

function console_log($message) {
  $STDERR = fopen("php://stderr", "w");
            fwrite($STDERR, "\n".$message."\n\n");
            fclose($STDERR);
}
    ?>