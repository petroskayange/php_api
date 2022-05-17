<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/price.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $price = new Price($db);

  // Blog price query
  $result = $price->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any prices
  if($num > 0) {
    // price array
    $prices_arr = array();
    // $prices_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $price_item = array(
        'id' => $id,
        'amount' => $amount,
        'title' => $title,
        'name' => $name
      );

      // Push to "data"
      array_push($prices_arr, $price_item);
      // array_push($prices_arr['data'], $price_item);
    }

    // Turn to JSON & output
    print_r(json_encode($prices_arr));

  } else {
    // No prices
    echo json_encode(
      array('message' => 'No prices Found')
    );
  }
