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
  <title>To-Do LiST</title>
  <link rel="stylesheet" href="styles/register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <div class="container d-flex align-items-center justify-content-center">
    <div class="card py-2 px-4 rounded-4">
      <div class="card-header bg-transparent border-0 text-center">
        <h2 class="mb-0">To-Do LiST</h2>
        <p class="mb-0 mt-2">Join our tasks</p>
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
            <button type="submit" class="text-white btn btn-primary rounded-2 border-0 fw-bold btn-signup"> Sign up <i class="fa-solid fa-user-plus"></i>  </button>
            <div class="d-flex align-items-center my-3">
              <hr class="flex-grow-1">
              <span class="mx-2 text-muted">OR</span>
              <hr class="flex-grow-1">
            </div>
            <button class="text-sesondary border border-secondary rounded-2 btn-google-login">
              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADcAAAA4CAMAAABuU5ChAAAA+VBMVEX////pQjU0qFNChfT6uwU0f/O4zvs6gfSJr/j6twDoOisjePPoNSXpPjDrWU/oLRr+9vZ7pff/vAAUoUAkpEn0ran619b82pT7wgD+68j947H/+e7//PafvPm/0vuBw5Df7+P63tz3xcPxl5HnJQ7qUEXxj4n4z83zoJzqSz/vgXrucWrsY1r1tbHrSBPoOjbvcSr0kx74rRH80XntZC3xhSPmGRr86+r4sk/936EJcfPS3/yowvnbwVKjsTjx9f5urEjkuBu9tC+ErkJyvoRRpj2az6hWs23j6/0emX2z2btAiuI8k8AyqkE5nZU1pGxCiOxVmtHJ5M+PSt3WAAACGElEQVRIieWSa3fSQBCGk20CJRcW2AWKxgJtqCmieNdatV5SUtFq5f//GJeE7CXJJOT4TZ+PO+c58+7MaNr/SWd60mecTDs1pMFp28dODPZnZw/369TXseXqHNfCblDdte84krTDwUFFwnMnJyXm+bSsmZ/vlcb1+6A2x5C1xYeyPgIyJlhtYDjzjOYyZA3oFighLYxni8UMY6dCG/jy9KzTQfI8DXSnTNN0kcl1lNE9dlxYC8TnnEVmAJ02qHlPllyb58vgmQ2Np0tYgzGMo2ex6IKRihi1mPhcZyYuO8McL4yYl0vrrI6mJZpx9Or1mzqa10rFt8p7o5ArXh+lXutC8d6ZBdiXvH6PeyPFsw8KMBu8fsG9+3t473l9yD1vD+/BX3v1cgqv3lzE/8A9NCUK5sn33vugeN1DQTcVTbG/9M56H+lEAzg2d54t7iW5657xCdEx5PF+B9Lj9oO9z4hBgIZX6YyaXfmZaV9QQkU781h+Hra+7jQaFv6Or8RW3r1rhErES641D9XKigox8jJaQxyAfZOpIQm6kiuT6BvfujqVuEpkkY43u+d1RBBF35v55aVJidKSEBRFiJAk/+0PM3NjgjFFMLc/WVYzlzImLBPprzvzrlBjHUmZSH8DmqatS0QSZtcjTxUBWSlZw1bckhaYlISTcm1rIqKolJJxtRWnXUVscTFsjWFFwoy7WTM2+zX69/gDaLcy7SET9nsAAAAASUVORK5CYII=" class="google">
              Continue with Google
            </button>
            <div class="d-flex justify-content-center mt-4">
              <span>Already have an account? <a href="login.php">Sign in here</a></span>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="popup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

