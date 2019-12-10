<?php
  session_start();
  require_once 'db/pdo.php';

  if(isset($_POST['email']) && isset($_POST['password'])) {
    $em = $_POST['email'];
    $pw = $_POST['password'];

    // $sql = "SELECT fullname, user_id FROM user WHERE email = :em AND password = :pw";
    $sql = "SELECT fullname, user_id FROM user WHERE email = '$em' AND password = '$pw'";
    $stmt = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($stmt);
    

    $verify_pw = password_verify($pw, $row['password']);
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(array(
    //   ':em' => $_POST['email'],
    //   ':pw' => $_POST['password']
    // ));
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // if(!$row->num_rows > 0) {  
    if($row === false && $verify_pw === false) {
      $_SESSION['error'] = 'Sign in failed.';
      header('Location: login.php');
      return;
    } else {
      $_SESSION['success'] = 'Signed in.';
      $_SESSION['account'] = $row['fullname'];
      $_SESSION['user_id'] = $row['user_id'];
      header('Location: dashboard.php');
      return;
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Todo App</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/signin.css">
  </head>

  <body class="text-center">
    <div class="row">
      <div class="col-md-9">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form class="form-signin" style="width: 330px;" method="post">
        <?php
          if(isset($_SESSION['error'])) {
        ?>
            <div class='alert alert-danger'><?= $_SESSION['error'] ?></div>
        <?php
              unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])) {
        ?>
            <div class='alert alert-success'><?= $_SESSION['success'] ?></div>
        <?php
              unset($_SESSION['success']);
            }
        ?>
        <p class="lead">Default login:</p>
        <p>admin@todo.com, admin</p>
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="email" class="sr-only">Email address</label>
        <input type="text" name="email" class="form-control" placeholder="Email address" autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password">
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2015-<?= date('Y'); ?></p>
      </form>
      </div>
    </div>
    
  </body>
</html>