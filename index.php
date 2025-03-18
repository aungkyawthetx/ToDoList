<?php
  session_start();
  include('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>To-Do LiST</title>
  <link rel="stylesheet" href="styles/general.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">
    <div class="row py-2 px-0 main-container">
      <div class="col-lg-2 sidebar py-2">
        <h1 class="text-white mb-3"> <i class="fa-solid fa-list-check"></i> To-Do LiST</h1>
        <div class="mt-0" id="clock">
          <?php echo date("h:i:s"); ?>
          </div>
          <a class="fs-3 mt-3 rounded-2" href="index.php"> <i class="bi bi-grid"></i> Dashboard</a>
      </div>

      <div class="col-lg-10 right-container">
        <div class="card rounded">
          <div class="card-header bg-transparent">
            <p class="fs-5 text-secondary fw-bold"> <i class="fa-solid fa-list-check fs-4"></i> Dashboard Overview</p>
          </div>
          <div class="card-body">
              <div class="d-flex align-items-center">
                <h1 class="fs-2"> My To-Do</h1>
                <div class="d-flex align-items-center ms-auto">
                  <button class="btn btn-primary btn-lg fs-4 d-none d-md-inline" onclick="togglePopup()"> <i class="fa-solid fa-circle-plus"></i> New Task </button>
                  <span onclick="togglePopup()" class="d-md-none"> <i class="fa-solid fa-circle-plus text-primary icon-btn"></i> </span>
                  <h3 class="fs-3 mx-3">
                    <?php 
                      if(isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                      } else {
                        echo "Guest";
                      }
                    ?>
                  </h3>
                  <div class="dropdown">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/020/765/399/small_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg" 
                        alt="Profile Picture" 
                        class="img-fluid border border-2 border-secondary" 
                        style="width: 30px; height: 30px; border-radius: 50%; cursor: pointer;" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <form action="logout.php" method="post">
                          <button name="btnLogout" type="submit" class="dropdown-item text-danger fs-4"> <i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
                </div>
              </div>

              <div id="popup" class="popup-form" onclick="event.stopPropagation()">
                <div class="card rounded border-0 bg-transparent">
                    <div class="card-body">
                        <form action="create.php" method="post" class=" d-flex flex-column">
                          <input type="text" name="title" class="form-control mb-3 rounded-2 fs-5" placeholder="Title" required>
                          <textarea name="discription" rows="5" class="form-control rounded-2 fs-5 mb-3" placeholder="Description" required></textarea>
                          <input name="date" type="date" class="form-control rounded-2 mb-3 p-3 fs-5" required>
                          <label for="status" class="fs-5 mb-1 text-info ms-1 text-uppercase">Please choose status*</label>
                          <select name="status" class="form-control rounded-2 mb-3" required>
                            <option value="To Start" class="form-control fs-5">To Start</option>
                            <option value="In Progress" class="form-control fs-5">In Progress</option>
                          </select>
                          <button name="btnAddTask" class="btn btn-primary btn-lg fs-4 border-0 mb-2">Add Task</button>
                          <button type="button" class="btn btn-secondary btn-lg fs-4 border-0" onclick="togglePopup()">Cancel</button>
                        </form>
                    </div>
                </div>
              </div>

              <!-- display task -->
              <div class="row mt-3 mx-1 status">
                <div class="col-lg-4">
                  <h4> <i class="bi bi-card-checklist text-success mx-0"></i> To Start</h4>
                </div>
                <div class="col-lg-4">
                  <h4> <i class="bi bi-clock-fill text-warning"></i> In Progress</h4>
                </div>
                <div class="col-lg-4">
                  <h4> <i class="bi bi-check-circle-fill text-success"></i> Completed</h4>
                </div>
              </div>

              <div class="row second-row my-2 mx-2">
                  <?php foreach ($groupTasks as $status => $tasks): ?>
                    <div class="col-lg-4">
                      <?php foreach($tasks as $task): ?>
                        <div class="card rounded-4 my-2 mb-4 mt-0"  data-task-id="<?php echo $task->id; ?>">
                          <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                              <h3><?php echo $task->title ?></h3>
                              <div class="dropdown ms-auto">
                                <button class="btn btn-link text-dark fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                  <?php if($task->status !== 'Completed'): ?>
                                  <li>
                                    <form method="get" action="edit.php">
                                        <input type="hidden" name="task_id" value="<?php echo $task->id; ?>"> 
                                        <a href="edit.php?id=<?php echo $task->id ?>" type="submit" class="dropdown-item fs-4">Edit</a>
                                    </form>
                                  </li>
                                  <li>
                                    <form action="markascompleted.php" method="post">
                                      <input type="hidden" name="task_id" value="<?php echo $task->id ?>">
                                      <button type="submit" class="dropdown-item text-success fs-4" onsubmit="moveTaskToCompleted(<?php echo $task->id; ?>, event)">Mark As Completed</button>
                                    </form>
                                  </li>
                                  <?php endif; ?>
                                  <li>
                                    <form method="post" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        <input type="hidden" name="task_id" value="<?php echo $task->id ?>"> 
                                        <a href="delete.php?id=<?php echo $task->id; ?>" type="submit" class="dropdown-item text-danger fs-4">Delete</a>
                                    </form>
                                  </li>
                              </ul>
                              </div>
                            </div>
                            <p style="text-align: justify;">
                              <?php echo $task->description ?>
                            </p>
                            <span class="fs-5 rounded-1 px-1 py-0 bg-secondary text-white date-span"> <?php echo $task->created_date ?> </span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endforeach; ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="container-fluid text-center mt-3 d-flex justify-content-center align-items-center" style="height: 50px; background-color: #202D48;">
    <small class="text-white fs-4">&copy; 2025 All right reserved by Aung Kyaw Thet.</small>
  </footer>

  <script>
    //mark as completed
  function moveTaskToCompleted(taskId, event) {
    event.preventDefault();

    fetch('markascompleted.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `task_id=${taskId}`
    })
    .then(response => {
      if (response.ok) {
        const taskCard = document.querySelector(`[data-task-id="${taskId}"]`);
        if (taskCard) taskCard.remove();
      } else {
        alert('Failed to move task. Please try again.');
      }
    })
    .catch(error => console.error('Error:', error));
  }

  //clock 
  function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').innerHTML = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="popup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
