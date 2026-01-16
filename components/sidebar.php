<aside class="col-lg-2 sidebar" id="sidebar">
  <h5>To Do App</h5>
  <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
  <a href="calendar.php"><i class="fa-solid fa-calendar"></i> Calendar</a>
  <a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
  <div class="clock-card">
    <div class="clock-card-header">
      <span>Clock</span>
    </div>
    <div class="clock-card-body">
      <div class="clock-display" id="clock">
        <?php echo date("h:i:s"); ?>
      </div>
    </div>
  </div>
  <div class="sidebar-footer">
    &copy; 2026 To Do App.
  </div>
</aside>