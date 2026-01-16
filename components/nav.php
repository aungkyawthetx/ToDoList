<div class="top-navbar d-none d-lg-flex justify-content-between align-items-center mb-4">
  <div class="navbar-left">
    <h5 class="page-title mb-0"> <?= $pageTitle ?? 'Dashboard' ?> </h5>
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
        <form action="logout.php" method="post">
          <button type="submit" name="btnLogout" class="btn-logout text-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Mobile Top Bar -->
<div class="mobile-topbar d-lg-none">
  <button class="mobile-menu-btn" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
  </button>
  
  <div class="d-flex align-items-center gap-3">
    <div class="mobile-notification-dropdown-wrapper">
      <button class="mobile-icon-action" id="mobile-notif-button">
        <i class="fa-solid fa-bell"></i>
      </button>
      <div class="mobile-notification-dropdown" id="mobile-notif-dropdown">
        <ul>
          <li>No new notifications</li>
        </ul>
      </div>
    </div>

    <div class="mobile-user" id="mobile-user-btn">
      <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['username'] ?? 'Guest' ?>&background=334977&color=fff" alt="User" onclick="toggleMobileUserMenu()"/>
      <span><?= $_SESSION['username'] ?? 'Guest' ?></span>
      <i class="fa-solid fa-chevron-down"></i>
      <div class="mobile-user-menu" id="mobile-user-menu">
        <a href="profile.php" class="text-dark text-decoration-none">Profile</a>
        <form action="logout.php" method="post">
          <button type="submit" name="btnLogout" class="text-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
