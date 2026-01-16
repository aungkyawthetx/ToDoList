<?php foreach ($groupTasks as $status => $tasks): ?>
  <?php foreach($tasks as $task): ?>
    <div class="task-card">
      <div>
        <div class="task-title"> <?=  htmlspecialchars($task->title ?? 'Untitled') ?> </div>
        <div class="task-date">
          <?= date('M d, Y', strtotime($task->created_date)) ?>
        </div>
      </div>
      <form action="delete.php?id=<?php echo $task->id; ?>" method="POST">
        <input type="hidden" name="task_id" value="<?= $task->id ?>">
        <button type="submit" name="btnDeleteTask" class="btn-delete-task text-danger" title="Delete Task">
          <i class="fa-solid fa-trash-can"></i>
        </button>
      </form>
    </div>
  <?php endforeach; ?>
<?php endforeach; ?>