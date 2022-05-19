<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/user.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $User = new User($db);

  // Blog User query
  $result = $User->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Users
  if($num > 0) {
    // User array
    $Users_arr = array();
    $Users_arr['user_data'] = array();
    $Users_arr['customer_data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $User_item = array(
        'username' => $username,
        'role' => $role,
        'userID' => $userID,
        'loginID' => $loginID,
        'firstName' => $firstName,
        'LastName' => $LastName,
        'Email' => $Email,
        'Address' => $Address,
        'Contact' => $Contact
      );

    //   // Push to "data"
      if($role == 'Admin')
        array_push($Users_arr['user_data'], $User_item);
      else
        array_push($Users_arr['customer_data'], $User_item);
    }

    // Turn to JSON & output
    print_r(json_encode($Users_arr));

  } else {
    // No Users
    print_r(json_encode($Users_arr));
  }
