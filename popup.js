function togglePopup() {
  const popup = document.getElementById('popup');
  const overlay = document.getElementById('overlay');

  if (popup.style.display === 'block') {
    popup.style.display = 'none';
    overlay.style.display = 'none';
  } else {
    popup.style.display = 'block';
    overlay.style.display = 'block';
  }
}
