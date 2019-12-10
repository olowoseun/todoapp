<?php 
  require_once '../db/pdo.php';
  session_start();

  $todo_id = $_GET['todo_id'];

  if(isset($_POST['delete']) && isset($_POST['todo_id'])) {
    $sql = "DELETE FROM todo WHERE todo_id = '$todo_id'";
    if($conn->query($sql) === true) {
      $_SESSION['success'] = 'Todo deleted.';
      header('Location: todo-list.php');
      return;
    }
  }

  // Guardian: make sure that the user_id is present
  if(! isset($_GET['todo_id'])) {
    $_SESSION['error'] = 'Missing user_id.';
    header('Location: todo-list.php');
    return;
  }

  $stmt = $conn->query("SELECT title, todo_id FROM todo WHERE todo_id = '$todo_id'");
  $row = $stmt->fetch_assoc();
  if($row === false) {
    $_SESSION['error'] = "Bad value for the user_id";
    header('Location: todo-list.php');
    return;
  }
?> 

<?php include_once '../includes/header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  
  <h1 class="h2">Confirm: Deleting <?= htmlentities($row['title']) ?> </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <form method="post">
        <input type="hidden" name="todo_id" value="<?= $row['todo_id']; ?>">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-outline-secondary" type="submit" name="delete">Delete</button>
          <a class="btn btn-sm btn-outline-secondary" href="todo-list.php">Cancel</a>
        </div>
      </form>  
    </div>            
  </div>

<?php include_once '../includes/footer.php'; ?>