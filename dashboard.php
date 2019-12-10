<?php 
  require_once 'db/pdo.php';
  session_start();

  if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  } else {
    header('Location: index.php');
    return;
  }
?>

<?php include_once 'includes/header.php'; ?>
        
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        This week
      </button>
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
      <div class="col-md-6">
        <canvas class="my-4 w-100 chartjs-render-monitor" id="lineChart" width="2246" height="948" style="display: block; height: 474px; width: 1123px;"></canvas>    
      </div>
      <div class="col-md-6">
        <canvas class="my-4 w-100 chartjs-render-monitor" id="barChart" width="2246" height="948" style="display: block; height: 474px; width: 1123px;"></canvas>    
      </div>
  </div>
  
  <div class="row">
      <div class="col-md-12">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Number of Todos</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // $stmt = $pdo->query("SELECT User.fullname AS fullname, COUNT(User.user_id) AS todos 
              // FROM User
              // INNER JOIN Todo
              // ON User.user_id=Todo.user_id
              // GROUP BY User.user_id
              // ORDER BY User.fullname ASC");
              $stmt = $conn->query("SELECT User.fullname AS fullname, COUNT(User.user_id) AS todos 
              FROM User
              INNER JOIN Todo
              ON User.user_id=Todo.user_id
              GROUP BY User.user_id
              ORDER BY User.fullname ASC");
              while($row = $stmt->fetch_assoc()) {
            ?>
                <tr>
                  <td><?= htmlentities($row["fullname"]); ?></td>
                  <td><?= htmlentities($row["todos"]); ?></td>                  
                </tr>           
              <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  
  </div>
    
<?php
  include_once 'includes/footer.php';
?>
        