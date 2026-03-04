<?php
  ob_start();
  session_start();
  include __DIR__ . '/config.php';
  $pageTitle = 'Profile';

  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
  }

  $userId = (int)$_SESSION['user_id'];
  $stmt = $pdo->prepare("SELECT username, password FROM users WHERE id = :id LIMIT 1");
  $stmt->execute(['id' => $userId]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
    header("Location: logout.php");
    exit;
  }

  $username = trim((string)$user['username']);
  $_SESSION['username'] = $username;

  $errorMessages = [];
  $successMessage = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string)($_POST['action'] ?? '');

    if ($action === 'change_username') {
      $newUsername = trim((string)($_POST['new_username'] ?? ''));
      $currentPassword = (string)($_POST['username_current_password'] ?? '');

      if ($newUsername === '') {
        $errorMessages[] = 'New username is required.';
      }

      if ($currentPassword === '') {
        $errorMessages[] = 'Current password is required.';
      } elseif (!password_verify($currentPassword, (string)$user['password'])) {
        $errorMessages[] = 'Current password is incorrect.';
      }

      if (empty($errorMessages)) {
        $usernameCheckStmt = $pdo->prepare(
          "SELECT id FROM users WHERE username = :username AND id != :id LIMIT 1"
        );
        $usernameCheckStmt->execute([
          'username' => $newUsername,
          'id' => $userId
        ]);

        if ($usernameCheckStmt->fetch(PDO::FETCH_ASSOC)) {
          $errorMessages[] = 'This username is already taken.';
        }
      }

      if (empty($errorMessages)) {
        $updateUsernameStmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
        $updateUsernameStmt->execute([
          'username' => $newUsername,
          'id' => $userId
        ]);

        $username = $newUsername;
        $_SESSION['username'] = $newUsername;
        $successMessage = 'Username changed successfully.';
      }
    }

    if ($action === 'change_password') {
      $currentPassword = (string)($_POST['password_current_password'] ?? '');
      $newPassword = (string)($_POST['new_password'] ?? '');
      $confirmPassword = (string)($_POST['confirm_password'] ?? '');

      if ($currentPassword === '') {
        $errorMessages[] = 'Current password is required.';
      } elseif (!password_verify($currentPassword, (string)$user['password'])) {
        $errorMessages[] = 'Current password is incorrect.';
      }

      if ($newPassword === '') {
        $errorMessages[] = 'New password is required.';
      } elseif (strlen($newPassword) < 6) {
        $errorMessages[] = 'New password must be at least 6 characters.';
      }

      if ($confirmPassword === '') {
        $errorMessages[] = 'Confirm password is required.';
      } elseif ($newPassword !== $confirmPassword) {
        $errorMessages[] = 'New password and confirm password do not match.';
      }

      if (empty($errorMessages)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $updatePasswordStmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $updatePasswordStmt->execute([
          'password' => $hashedPassword,
          'id' => $userId
        ]);

        $successMessage = 'Password changed successfully.';
      }
    }

    // Refresh user row to keep current data in memory after updates
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<div class="profile-page">
  <div class="profile-card">
    <div class="profile-hero">
      <div class="profile-card-header">
        <img
          class="profile-avatar-img"
          src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['username'] ?? 'Guest') ?>&background=334977&color=fff"
          alt="User Avatar"
        >
        <div>
          <h4 class="mb-1 text-white">My Profile</h4>
          <p class="mb-0 profile-subtitle">Account overview</p>
        </div>
      </div>
    </div>

    <div class="profile-form-wrap">
      <?php if (!empty($errorMessages)): ?>
        <div class="alert alert-danger profile-alert mb-3">
          <?php foreach ($errorMessages as $message): ?>
            <div><?= htmlspecialchars($message) ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($successMessage !== ''): ?>
        <div class="alert alert-success profile-alert mb-3"><?= htmlspecialchars($successMessage) ?></div>
      <?php endif; ?>

      <div class="profile-meta-row">
        <div>
          <p class="profile-meta-title mb-1">Account Information</p>
          <p class="profile-meta-text mb-0">Use the buttons below to update your account credentials.</p>
        </div>
      </div>

      <div class="profile-details-card mb-3">
        <div class="profile-detail-row">
          <span class="profile-detail-label">Username</span>
          <span class="profile-detail-value"><?= htmlspecialchars((string)$user['username']) ?></span>
        </div>
        <div class="profile-detail-row">
          <span class="profile-detail-label">Password</span>
          <span class="profile-detail-value profile-password-mask">********</span>
        </div>
      </div>

      <div class="profile-actions-grid">
        <div class="profile-action-card">
          <h6 class="profile-action-title">Change Username</h6>
          <form method="POST">
            <input type="hidden" name="action" value="change_username">
            <div class="mb-2">
              <label for="new_username" class="form-label">New Username</label>
              <input
                id="new_username"
                name="new_username"
                type="text"
                class="form-control profile-input"
                value="<?= htmlspecialchars((string)($_POST['new_username'] ?? '')) ?>"
              >
            </div>
            <div class="mb-3">
              <label for="username_current_password" class="form-label">Current Password</label>
              <input
                id="username_current_password"
                name="username_current_password"
                type="password"
                class="form-control profile-input"
              >
            </div>
            <button type="submit" class="btn profile-save-btn">Change Username</button>
          </form>
        </div>

        <div class="profile-action-card">
          <h6 class="profile-action-title">Change Password</h6>
          <form method="POST">
            <input type="hidden" name="action" value="change_password">
            <div class="mb-2">
              <label for="password_current_password" class="form-label">Current Password</label>
              <input
                id="password_current_password"
                name="password_current_password"
                type="password"
                class="form-control profile-input"
              >
            </div>
            <div class="mb-2">
              <label for="new_password" class="form-label">New Password</label>
              <input
                id="new_password"
                name="new_password"
                type="password"
                class="form-control profile-input"
              >
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input
                id="confirm_password"
                name="confirm_password"
                type="password"
                class="form-control profile-input"
                required
              >
            </div>
            <button type="submit" class="btn profile-save-btn">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  $content = ob_get_clean();
  include __DIR__ . '/components/layout.php';
?>
