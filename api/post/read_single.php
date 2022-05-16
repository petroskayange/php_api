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
  $post = new Payment($db);

  // Get ID
  $post->referenceNumber = isset($_GET['referenceNumber']) ? $_GET['referenceNumber'] : die();

  // Get post
  if($post->read_single()){
    // Create array
    $post_arr = array(
      'name' => $post->name,
      'status' => $post->status,
      'quantity' => $post->quantity,
      'destination' => $post->destination,
      'amount' => $post->amount,
      'paymentMethod' => $post->paymentMethod,
      'paymentAt' => $post->paymentAt,
    );
  }else{
    header('HTTP/1.1 501 Parcel not found', true, 501);
  }

  // Make JSON
  print_r(json_encode($post_arr));