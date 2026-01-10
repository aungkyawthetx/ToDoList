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
  <link rel="stylesheet" href="styles/layout.css?v=<?= time() ?>" />
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
    <h5 class="mb-3">Add New Task</h5>
    <form action="create.php" method="POST">
      <input type="text" name="title" class="form-control mb-2" placeholder="Task title" required>
      <input type="date" name="date" class="form-control mb-3"required>
      <button type="submit" name="btnAddTask" class="btn btn-primary w-100">Save</button>
    </form>
  </div>

<script>
  function openPopup() {
    document.getElementById('overlay').classList.add('show');
    document.getElementById('popup').classList.add('show');
  }

  function closePopup() {
    document.getElementById('overlay').classList.remove('show');
    document.getElementById('popup').classList.remove('show');
  }

  // Clock Update
    function updateClock() {
      const now = new Date();
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      document.getElementById('clock').innerHTML = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // notification dropdown
    const notifButton = document.getElementById('notif-button');
    const notifDropdown = document.getElementById('notif-dropdown');
    notifButton.addEventListener('click', () => {
      notifDropdown.style.display = notifDropdown.style.display === 'block' ? 'none' : 'block';
    });
    // user dropdown
    const userButton = document.getElementById('user-btn');
    const userMenu = document.getElementById('user-menu');
    userButton.addEventListener('click', () => {
      userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
    });
    
    document.addEventListener('click', function(event) {
      if (!notifButton.contains(event.target) && !notifDropdown.contains(event.target)) {
        notifDropdown.style.display = 'none';
      }
      if (!userButton.contains(event.target) && !userMenu.contains(event.target)) {
        userMenu.style.display = 'none';
      }
    });
</script>
</body>
</html>
