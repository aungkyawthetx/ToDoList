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
  //mobile notification dropdown
  const mobileNotifButton = document.getElementById('mobile-notif-button');
  const mobileNotifDropdown = document.getElementById('mobile-notif-dropdown');
  mobileNotifButton.addEventListener('click', () => {
    mobileNotifDropdown.style.display = mobileNotifDropdown.style.display === 'block' ? 'none' : 'block';
  });
  // user dropdown
  const userButton = document.getElementById('user-btn');
  const userMenu = document.getElementById('user-menu');
  userButton.addEventListener('click', () => {
    userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
  });
  //mobile user dropdown
  const mobileUserButton = document.getElementById('mobile-user-btn');
  const mobileUserMenu = document.getElementById('mobile-user-menu');
  mobileUserButton.addEventListener('click', () => {
    mobileUserMenu.style.display = mobileUserMenu.style.display === 'block' ? 'none' : 'block';
  });
  
  document.addEventListener('click', function(event) {
    if (!notifButton.contains(event.target) && !notifDropdown.contains(event.target) && !mobileNotifButton.contains(event.target) && !mobileNotifDropdown.contains(event.target)) {
      notifDropdown.style.display = 'none';
      mobileNotifDropdown.style.display = 'none';
    }
    if (!userButton.contains(event.target) && !userMenu.contains(event.target) && !mobileUserButton.contains(event.target) && !mobileUserMenu.contains(event.target)) {
      userMenu.style.display = 'none';
      mobileUserMenu.style.display = 'none';
    }
  });

  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
    document.querySelector('.sidebar-overlay').classList.toggle('show');
  }

  function toggleMobileUserMenu() {
    document.getElementById('mobile-user-menu').classList.toggle('show');
  }

  function enableEdit(button) {
    const card = button.closest(".task-card");
    card.querySelector(".task-view").classList.add("d-none");
    card.querySelector(".task-edit").classList.remove("d-none");
  }

  function cancelEdit(button) {
    const card = button.closest(".task-card");
    card.querySelector(".task-edit").classList.add("d-none");
    card.querySelector(".task-view").classList.remove("d-none");
  }
