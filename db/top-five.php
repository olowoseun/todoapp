<?php 
  require_once 'pdo.php';
  require_once 'user-todo.php';

  session_start();

  $rows = array();
  // $stmt = $pdo->prepare("SELECT User.fullname AS fullname, COUNT(User.user_id) AS todos 
  //                         FROM User
  //                         INNER JOIN Todo
  //                         ON User.user_id=Todo.user_id
  //                         GROUP BY User.user_id
  //                         ORDER BY User.fullname ASC");
                          
  $stmt = $conn->query("SELECT User.fullname AS fullname, COUNT(User.user_id) AS todos 
                          FROM User
                          INNER JOIN Todo
                          ON User.user_id=Todo.user_id
                          GROUP BY User.user_id
                          ORDER BY User.fullname ASC");
                          
  // $stmt->execute();
  
  while($row = $stmt->fetch_assoc()) {
    $user_todo = new UserTodo($row['fullname'], $row['todos']);
    array_push($rows, $user_todo  );
  }

  if(!isset($_SESSION['users'])) $_SESSION['users'] = $rows;
  echo(json_encode($_SESSION['users']));
  
  // if(isset($_SESSION['user_id'])) {
  //   $user_id = $_SESSION['user_id'];
  // } else {
  //   header('Location: ../index.php');
  //   return;
  // }
?>        