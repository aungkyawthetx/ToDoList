<div class="top-navbar d-flex justify-content-between align-items-center mb-4">
  <div class="navbar-left">
    <h5 class="page-title mb-0">Dashboard</h5>
  </div>

  <div class="navbar-right d-flex align-items-center gap-3">
    <div class="notification-dropdown-wrapper">
      <button class="icon-action" id="notif-button">
        <i class="fa-solid fa-bell"></i>
      </button>
      <div class="notification-dropdown" id="notif-dropdown">
        <ul>
          <li>No new notifications</li>
        </ul>
      </div>
    </div>

    <div class="user-dropdown" id="user-btn">
      <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['username'] ?? 'Guest' ?>&background=334977&color=fff" alt="User Avatar">
      <span class="user-name">
        <?php 
          if(isset($_SESSION['username'])) {
            echo $_SESSION['username'];
          } else {
            echo "Guest";
          }
        ?>
      </span>
      <i class="fa-solid fa-chevron-down"></i>
      <div class="user-menu" id="user-menu">
        <a href="profile.php">Profile</a>
        <form action="logout.php" method="POST">
          <button type="submit" class="btn-logout text-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>