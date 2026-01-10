<?php foreach ($groupTasks as $status => $tasks): ?>
  <?php foreach($tasks as $task): ?>
    <div class="task-card">
      <div class="task-title"> <?=  htmlspecialchars($task->title ?? 'Untitled') ?> </div>
      <div class="task-date">
        <?= date('M d, Y', strtotime($task->created_date)) ?>
      </div>
      <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
        <input type="hidden" name="task_id" value="<?= $task->id ?>">
        <button type="submit" name="btnDeleteTask" class="btn-delete-task" title="Delete Task">
          <i class="fa-solid fa-trash"></i>
        </button>
    </div>
  <?php endforeach; ?>
<?php endforeach; ?>