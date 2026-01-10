<?php
include 'config.php';
$usernameDuplicateErr = '';
$NullErrorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $rawPassword = $_POST['password']; // Get raw password

    // username check 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() > 0) {
        $usernameDuplicateErr = 'username already exists!';
    } 
    elseif (empty($username) || empty($rawPassword)) {
        $NullErrorMsg = 'username and password are required!';
    }
    else {
        $hashedPassword = password_hash($rawPassword, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);

        if ($stmt->rowCount() > 0) {
            header("Location: login.php");
            exit();
        } else {
            echo "Registration failed!";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>To-Do List</title>
  <link rel="stylesheet" href="styles/register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <div class="container d-flex align-items-center justify-content-center">
    <div class="card py-2 px-4 rounded-4">
      <div class="card-header bg-transparent border-0 text-center">
        <h2 class="mb-0">To-Do List</h2>
        <p class="mb-0 mt-2">Join Us</p>
      </div>
      <div class="card-body">
      <span class="text-danger"><?php echo $usernameDuplicateErr; ?></span>
        <form method="post">
          
          <span class="text-danger"><?php echo $NullErrorMsg; ?></span>
            <div class="mb-3">
              <input type="text" name="username" class="form-control rounded-2" placeholder="Username">
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control rounded-2" placeholder="Password">
            </div>
            <button type="submit" class="text-white btn btn-primary rounded-2 border-0 fw-bold btn-signup"> Sign up  </button>
            <div class="d-flex align-items-center my-3">
              <hr class="flex-grow-1">
              <span class="mx-2 text-muted">OR</span>
              <hr class="flex-grow-1">
            </div>
            <div class="d-flex justify-content-center mt-4">
              <span>Already have an account? <a href="login.php">Login</a></span>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="popup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

