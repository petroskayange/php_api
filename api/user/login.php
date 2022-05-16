<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 
 include_once '../../config/Database.php';
 include_once '../../models/login.php';
 include_once '../../models/user.php';
 include_once '../../config/settings.php';
 $_SESSION['login_message'] = '';
 if($_POST['username']  && $_POST['password'])
 {
     // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Login($db);

    // Get ID
    $post->username = $_POST['username'];
    $post->password = $_POST['password'];

    // Get post
    $post->read_single();
  // Create array
  if($post->username)
  {
      $post_arr = array(
      'username' => $post->username,
      'loginID' => $post->loginID,
      'Contact' => $post->Contact,
      'Address' => $post->Address,
      'Email' => $post->Email,
      'LastName' => $post->LastName,
      'firstName' => $post->firstName,
      'role' => $post->role
    );
    
    // Make JSON
    $_SESSION['login_status'] ="login successfully";
    if($post_arr['role'] == 'Admin' && !isset($_GET['platform']))
      return header('HTTP/1.1 401 Unauthorized', true, 401);

    if($post_arr['role'] != 'Admin' && isset($_GET['platform']))
      return header('HTTP/1.1 401 Unauthorized', true, 401);
    if($post_arr['role'] == 'Admin' && $_GET['platform'] == 'website'){
      echo json_encode("login successfully");
      // header("Location: ".$base_url."/views/dashboard.php");
      // die();
    }else{
      print_r(json_encode($post_arr));
    }
  }
  else{
    header('HTTP/1.1 400 Fail to login', true, 400);
  }
  
    
 }else
 {
    print_r("Fail to login");
    header('HTTP/1.1 401 Unauthorized', true, 401);
 }

// function console_log($message) {
//     $STDERR = fopen("php://stderr", "w");
//               fwrite($STDERR, "\n".$message."\n\n");
//               fclose($STDERR);
// }
// function goHome(){
//   global $base_url;
//   if(isset($_GET['platform'])){
//     if($_GET['platform'] == 'website'){
//       $_SESSION['login_message'] = 'Wrong Password or Username';
//       header("Location: ".$base_url);
//     }else
//     header('HTTP/1.1 401 Unauthorized', true, 401);
//   }else
//   header('HTTP/1.1 401 Unauthorized', true, 401);
  
// }
?>