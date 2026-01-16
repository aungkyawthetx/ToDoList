<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>To Do App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/app.css" />
  <link rel="stylesheet" href="styles/nav.css" />
  <link rel="stylesheet" href="styles/calendar.css" />
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php include __DIR__ . '/components/sidebar.php'; ?>
      <!-- Main -->
      <main class="col-lg-10 right-container">
        <?php include __DIR__ . '/components/nav.php'; ?>
        <?php echo $content ?? '' ?>
      </main>
    </div>
  </div>

  <!-- Popup -->
  <div class="overlay" id="overlay" onclick="closePopup()"></div>
  <div class="popup-form" id="popup">
    <h5 class="mb-3">Add New To Do</h5>
    <form action="create.php" method="POST">
      <input type="text" name="title" class="form-control mb-2" placeholder="What's your task for the day?" required>
      <input type="date" name="date" class="form-control mb-3"required>
      <button type="submit" name="btnAddTask" class="btn btn-primary w-100">Add To-Do</button>
    </form>
  </div>
  <script src="scripts/app.js"></script>
</body>
</html>
