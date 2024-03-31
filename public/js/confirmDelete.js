document.addEventListener('click', (e) => {
  if (e.target.classList.contains('delete-link')) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete this book?'))
      window.location.href = e.target.href;
  }
});