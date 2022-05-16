<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/parcel.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $Parcel = new Parcel($db);

  // Blog Parcel query
  $result = $Parcel->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Parcels
  if($num > 0) {
    // Parcel array
    $Parcels_arr = array();
    // $Parcels_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Parcel_item = array(
        'parcelID' => $parcelID,
        'name' => $name,
        'description' => html_entity_decode($description),
        'type' => $type,
        'fee' => $fee,
        'destination' => $destination,
        'referenceNumber' => $referenceNumber,
        'weight' => $weight,
        'PackageStatus' => $PackageStatus,
        'message' => $message,
        'location' => $location,
        'notificationID' => $notificationID,
        'receiver_phone' => $receiver_phone,
        'quantity' => $quantity,
        'status' => $status,
        'amount' => $amount,
        'paymentMethod' => $paymentMethod
      );

      // Push to "data"
      array_push($Parcels_arr, $Parcel_item);
      // array_push($Parcels_arr['data'], $Parcel_item);
    }

    // Turn to JSON & output
    print_r(json_encode($Parcels_arr));

  } else {
    // No Parcels
    echo json_encode(
      array('message' => 'No Parcels Found')
    );
  }
