<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/login.php';
  include_once '../../models/user.php';

  

  

  
  if( $_POST['username'] && 
      $_POST['password'] && 
      $_POST['role'] && 
      $_POST['firstName'] && 
      $_POST['LastName'] && 
      $_POST['Email'] && 
      $_POST['Address'] && 
      $_POST['Contact']){
    // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog payment object
  $user = new User($db);
  $login = new Login($db);

  // Get raw posted data
  $login->username = $_POST['username'];
  $login->password = $_POST['password'];
  $login->role = $_POST['role'];
  $user->Email = $_POST['Email'];

  if($login->read_single_username())
  {
    if($user->read_single_email() ){
      $loginID = $login->createLogin();
      $loginID = $login->getLoginId();

      console_log($loginID);
      // Create payment
        if($loginID) {
          $user->firstName = $_POST['firstName'];
          $user->LastName = $_POST['LastName'];
          $user->Address = $_POST['Address'];
          $user->Contact = $_POST['Contact'];
          $user->loginID = $loginID;
          if($user->createUser()){

          }else
          header('HTTP/1.1 400 Fail to create payment', true, 400);
          
        }else{
            echo json_encode(
                array('message' => 'Post Not Created')
              );
              header('HTTP/1.1 400 Fail to create payment', true, 400);
        }
    }else{
      header('HTTP/1.1 500 Email already exit', true, 500);
    }
  }else{
    header('HTTP/1.1 501 Username already exit', true, 501);
  }
}else
header('HTTP/1.1 422 Invalid Data', true, 422);

function console_log($message) {
  $STDERR = fopen("php://stderr", "w");
            fwrite($STDERR, "\n".$message."\n\n");
            fclose($STDERR);
}
    ?>