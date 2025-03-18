<?php
  session_start();
  include('config.php');

  if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
  }
  //get task 
  if(!empty($_GET['id'])) {
    $taskId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id=:id");
    $stmt->execute([
      'id' => $taskId
    ]);
    $task = $stmt->fetchObject();
  }

  // Update task
  if(isset($_POST['btnUpdate'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date = $_POST['date'];

    $stmt = $pdo->prepare("UPDATE tasks SET title= :title, description= :description, created_date= :date WHERE id= :id");
    $stmt->execute([
      'title' => $title,
      'description' => $description,
      'date' => $date,
      'id' => $id
    ]);
    if ($stmt) {
    header('Location:index.php');
    exit();
    } else {
      echo "Error: unalble to update!";
    }
  }
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
        <a class="fs-3 mt-3 rounded-2" href="edit.php?id=<?php echo $task->id ?>"> <i class="bi bi-pencil-square"></i> Edit</a>
      </div>

      <div class="col-lg-10 right-container">
        <div class="card">
          <div class="card-header bg-transparent">
            <p class="fs-5 text-secondary fw-bold"> <i class="bi bi-person-fill-up fs-4"></i> Update Task</p>
          </div>
          <div class="card-body my-3">
              <div class="d-flex align-items-center">
                <h1 class="fs-2"> My To-Do</h1>
                <div class="ms-auto d-flex align-items-center">
                  <h3 class="fs-2 mx-3">
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

              <div class="row my-5 second-row" id="edit-task">  
                <div class="col-lg-6">
                  <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body">
                      <form action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $task->id ?>">
                        <div class="mb-3">
                          <input name="title" type="text" class="form-control fs-5 rounded-1" placeholder="Title" value="<?php echo $task->title ?>" required>
                        </div>
                        <div class="mb-3">
                          <textarea name="description" class="form-control fs-5 rounded-2" rows="8" placeholder="Description" required> <?php echo $task->description ?> </textarea>
                        </div>
                        <div class="mb-3">
                          <input name="date" type="date" class="form-control fs-5 rounded-2" value="<?php echo $task->created_date ?>" required>
                        </div>
                        <button name="btnUpdate" class="btn btn-primary text-white fs-4 btn-update">Update</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="container-fluid text-center m-0 d-flex justify-content-center align-items-center" style="height: 50px; background-color: #202D48;">
    <small class="text-white fs-4">&copy; 2025 All right reserved by Aung Kyaw Thet.</small>
  </footer>

  <script>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
