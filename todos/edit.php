<?php
  require_once '../db/pdo.php';
  session_start();

  $todo_id = $_GET['todo_id'];

  if(isset($_POST['title']) && isset($_POST['description']) 
      && isset($_POST['todo_id'])) {
        // Data validation
        if(strlen($_POST['title']) < 1 || strlen($_POST['description']) < 1) {
          $_SESSION['error'] = 'Missing data.';
          header('Location: edit.php');
          return;
        }
      
        $date = new DateTime('Africa/Lagos');
        $updated_at = $date->format('Y-m-d H:i:s');
        $title = $_POST['title'];
        $desc = $_POST['description'];

        $sql = "UPDATE todo SET title = '$title',
                  description = '$desc', updated_at = '$updated_at'
                  WHERE todo_id = '$todo_id'";
        if($conn->query($sql) === true) {
          $_SESSION['success'] = 'Todo updated.';
          header('Location: todo-list.php');
          return;
        }  
  }

  // Guardian: make sure that the todo_id is present
  if(! isset($_GET['todo_id'])) {
    $_SESSION['error'] = 'Missing todo_id.';
    header('Location: todo-list.php');
    return;
  }
  
  $stmt = $conn->query("SELECT * FROM todo WHERE todo_id = '$todo_id'");
  $row = $stmt->fetch_assoc();
  if($row === false) {
    $_SESSION['error'] = "Bad value for the user_id";
    header('Location: todo-list.php');
    return;
  }
  $t = htmlentities($row['title']);
  $d = htmlentities($row['description']);
  $todo_id = $row['todo_id'];
?>

<?php include_once '../includes/header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">
      Edit Todo
      <?php
        // Flash pattern
        if(isset($_SESSION['error'])) {    
      ?>
      <p class="error"><?= $_SESSION['error'] ?></p>
      <?php 
          unset($_SESSION['error']);
        }
      ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">  
      <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9">
        <form method="post" action="">
          <div class="form-group">
            <label >Title</label>
            <input type="text" class="form-control" name="title" value="<?= $t ?>">
            <input type="hidden" name="todo_id" value="<?= $todo_id ?>">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="8">
              <?= $d ?>
            </textarea>
          </div> 
          <div class="btn-group mr-2">
            <button type="submit" class="btn btn-sm btn-outline-secondary">Submit</button>
            <a href="todo-list.php" class="btn btn-sm btn-outline-secondary">Cancel</a>
          </div>
      </form>  
    </div>
  </div>

<?php include_once '../includes/footer.php'; ?>