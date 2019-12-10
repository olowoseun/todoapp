<?php 
  require_once '../db/pdo.php';
  session_start();

  // Define variables and initialize with empty values
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";
  
  if(isset($_POST['fullname']) && isset($_POST['email']) 
      && isset($_POST['password'])) {
        // Data validation
        if(strlen($_POST['fullname']) < 1 || strlen($_POST['password']) < 1) {
          $_SESSION['error'] = 'Missing data.';
          header('Location: add.php');
          return;
        }
        if(strpos($_POST['email'], '@') === false) {
          $_SESSION['error'] = 'Bad data.';
          header('Location: add.php');
          return;
        }

        $fn = $_POST['fullname'];
        $em = $_POST['email'];
        $pw = $_POST['password'];
        $hashed_pw = password_hash($pw, PASSWORD_BCRYPT);
       
        $sql = "INSERT INTO user (fullname, email, password)
                  VALUES ('$fn', '$em', '$hashed_pw')";
        if($conn->query($sql) === true) {
          $_SESSION['success'] = 'User added.';
          header('Location: user-list.php');
          return;      
        }
  }
?>

<?php include_once '../includes/header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Add a New User</h1>
    <div class="btn-toolbar mb-2 mb-md-0">  
      <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9">
      <?php
        // Flash pattern
        if(isset($_SESSION['error'])) {
      ?>
        <div class="alert alert-danger">
        <?php
            echo($_SESSION['error']);
        ?>
      </div>
      <?php
          unset($_SESSION['error']);
        }
      ?>
        
    </div>
  </div>
  <div class="row">
    <div class="col-md-9">
        <form method="post" action="">
          <div class="form-group">
            <label >Full Name</label>
            <input type="text" class="form-control" name="fullname" placeholder="Full Name">
          </div>
          <div class="form-group">
            <label >Email address</label>
            <input type="text" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="btn-group mr-2">
            <button type="submit" class="btn btn-sm btn-outline-secondary">Submit</button>
            <a href="user-list.php" class="btn btn-sm btn-outline-secondary">Cancel</a>
          </div>
      </form>  
    </div>
  </div>

<?php include_once '../includes/footer.php'; ?>