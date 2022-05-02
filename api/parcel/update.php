<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/parcel.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog parcel object
  $parcel = new Parcel($db);

  // Get raw posted data
  // $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $parcel->parcelID = $_GET['parcelID'];
  $PackageStatus->status = $_GET['location'];

  // Update parcel
  if($parcel->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }

