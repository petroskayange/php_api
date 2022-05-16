<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/branch.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $branch = new Branch($db);

  // Blog branch query
  $result = $branch->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any branchs
  if($num > 0) {
    // branch array
    $branchs_arr = array();
    // $branchs_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $branch_item = array(
        'id' => $id,
        'name' => $name
      );

      // Push to "data"
      array_push($branchs_arr, $branch_item);
      // array_push($branchs_arr['data'], $branch_item);
    }

    // Turn to JSON & output
    print_r(json_encode($branchs_arr));

  } else {
    // No branchs
    echo json_encode(
      array('message' => 'No branchs Found')
    );
  }
