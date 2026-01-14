<aside class="col-lg-2 sidebar" id="sidebar">
  <h5>To Do App</h5>
  <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
  <a href="tasks.php"><i class="fa-solid fa-list-check"></i> Tasks</a>
  <a href="#"><i class="fa-solid fa-calendar"></i> Calendar</a>
  <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>

  <div class="clock-card">
    <div class="clock-card-header">
      <i class="fa-regular fa-clock"></i>
      <span>Current Date Time</span>
    </div>
    <div class="clock-card-body">
      <div class="clock-display" id="clock">
        <?php echo date("h:i:s"); ?>
      </div>
      <div class="clock-date">
        <?php echo date("l, F j, Y"); ?>
      </div>
    </div>
  </div>

  <div class="sidebar-footer">
    &copy; 2026 To Do App.
  </div>
</aside>