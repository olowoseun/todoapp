<?php 
  // $pdo = new PDO('mysql:host=localhost;port=8889;dbname=tododb', 'root', '');

  // see the "errors" folder for details...
  // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'todoapp');

  // Create connection
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>