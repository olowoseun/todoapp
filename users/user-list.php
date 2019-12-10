<?php 
  require_once '../db/pdo.php';
  session_start();

  if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  } else {
    header('Location: ../index.php');
    return;
  }
?>

<?php include_once '../includes/header.php'; ?>
        
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Users</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="add.php" class="btn btn-sm btn-outline-secondary">New</a>
          <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
      </div>
    </div>
   
    <div class="row">
      <div class="col-12">
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
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $stmt = $conn->query("SELECT * FROM user");
              while($row = $stmt->fetch_assoc()) {
            ?>
                <tr>
                  <td><?= htmlentities($row["user_id"]); ?></td>
                  <td><?= htmlentities($row["fullname"]); ?></td>
                  <td><?= htmlentities($row["email"]); ?></td>
                  <td><?= htmlentities($row["password"]); ?></td>
                  <td>                      
                    <a href="edit.php?user_id=<?= $row['user_id']; ?>" class="text-primary" title="Edit" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="delete.php?user_id=<?= $row['user_id']; ?>" class="text-danger" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>           
              <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
  include_once '../includes/footer.php';
?>
        