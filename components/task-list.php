<?php foreach ($groupTasks as $status => $tasks): ?>
  <?php foreach($tasks as $task): ?>
    <div class="task-card" data-task-id="<?= $task->id ?>">
      <div class="task-view">
        <div>
          <div class="task-title">
            <?= htmlspecialchars($task->title ?? 'Untitled') ?>
          </div>
          <div class="task-date">
            <?= date('M d, Y', strtotime($task->created_date)) ?>
          </div>
        </div>
        <div class="task-actions">
          <button type="button" class="btn-edit-task" onclick="enableEdit(this)">
            <i class="fa-solid fa-pen"></i>
          </button>
          <form action="delete.php?id=<?= $task->id ?>" method="POST">
            <input type="hidden" name="task_id" value="<?= $task->id ?>">
            <button type="submit" class="btn-delete-task text-danger">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </form>
        </div>
      </div>

      <!-- EDIT MODE -->
      <form action="update.php" method="POST" class="task-edit d-none">
        <input type="hidden" name="task_id" value="<?= $task->id ?>">
        <input
          type="text"
          name="title"
          class="form-control mb-2"
          value="<?= htmlspecialchars($task->title) ?>"
          required
        >
        <div class="d-flex gap-2">
          <button type="submit" name="btnUpdateTask" class="btn btn-sm btn-primary">
            Update Task
          </button>
          <button type="button" class="btn btn-sm btn-secondary" onclick="cancelEdit(this)">
            Cancel
          </button>
        </div>
      </form>
    </div>
  <?php endforeach; ?>
<?php endforeach; ?>