<?php
ob_start();
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="calendar-card">
        <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
          <button class="btn btn-light" id="prevMonth">
            <i class="fa-solid fa-chevron-left"></i>
          </button>

          <h5 class="mb-0" id="calendarTitle"></h5>

          <button class="btn btn-light" id="nextMonth">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>

        <div class="calendar-grid">
          <div class="calendar-day">Sun</div>
          <div class="calendar-day">Mon</div>
          <div class="calendar-day">Tue</div>
          <div class="calendar-day">Wed</div>
          <div class="calendar-day">Thu</div>
          <div class="calendar-day">Fri</div>
          <div class="calendar-day">Sat</div>
        </div>

        <div class="calendar-grid" id="calendarBody"></div>
      </div>
    </div>
  </div>
</div>

<script src="scripts/calendar.js"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
