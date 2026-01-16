<?php
  session_start();
  include 'config.php';

  if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
  }

  $nullErrorMsg = '';
  $invalid = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($username) || empty($password)) {
      $nullErrorMsg = '*username and password are required';
    } elseif ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header("Location: index.php");
      exit();
    } else {
      $invalid = '*Invalid username or password';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>To Do App</title>
  <link rel="stylesheet" href="styles/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <div class="container d-flex align-items-center justify-content-center">
    <div class="card py-3 px-4 rounded-4">
      <div class="card-header bg-transparent border-0 text-center">
        <h2 class="mb-0">Welcome back</h2>
      </div>
      <div class="card-body">
        <form method="POST">
            <p class="text-danger fst-italic mb-1 small"><?php echo $nullErrorMsg; ?></p>
            <span class="text-danger"> <?php echo $invalid; ?> </span>
            <div class="mb-3">
              <input type="text" name="username" class="form-control rounded-2" placeholder="Enter your username">
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control rounded-2" placeholder="password">
            </div>
            <button type="submit" name="btnLogin" class="text-white btn btn-primary rounded-2 border-0 fw-bold btn-login fs-5"> Login </button>
            <div class="d-flex align-items-center my-3">
              <hr class="flex-grow-1">
              <span class="mx-2 text-muted">OR</span>
              <hr class="flex-grow-1">
            </div>
            <div class="d-flex justify-content-center mt-4">
              <span>Don't have an account? <a href="register.php">Register</a></span>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="popup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>