<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Payment.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $Payment = new Payment($db);

  // Blog Payment query
  $result = $Payment->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Payments
  if($num > 0) {
    // Payment array
    $Payments_arr = array();
    // $Payments_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Payment_item = array(
        'paymentID' => $paymentID,
        'referenceNumber' => $referenceNumber,
        'amount' => $amount,
        'date' => $date,
        'type' => $type,
        'userID' => $userID,
        'paymentMethod' => $paymentMethod,
        'paymentAt' => $paymentAt,
        'status' => $status
      );

      // Push to "data"
      array_push($Payments_arr, $Payment_item);
      // array_push($Parcels_arr['data'], $Parcel_item);
    }

    // Turn to JSON & output
    print_r(json_encode($Payments_arr));

  } else {
    // No Parcels
    echo json_encode(
      array('message' => 'No Parcels Found')
    );
  }
