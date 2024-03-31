$(document).ready(function () {
  $('#btn-title').click(function () {
    if ($('#input-title').val()) {
      const title = $('#input-title').val();

      $.ajax({
        url: 'api/filterByTitle.php',
        type: 'POST',
        data: { title },
        success: printResults
      });
    }
  });

  $('#btn-isbn').click(function () {
    if ($('#input-isbn').val()) {
      const isbn = $('#input-isbn').val();

      $.ajax({
        url: 'api/filterByISBN.php',
        type: 'POST',
        data: { isbn },
        success: function (response) {
          let task = JSON.parse(response);
          if (!task) {
            $('#results-container').html('');
            return;
          }
          let template = getTemplateCard(task);
          $('#results-container').html(template);
        }
      });
    }
  });

  $('#btn-author').click(function () {
    if ($('#input-author').val()) {
      const author = $('#input-author').val();

      $.ajax({
        url: 'api/filterByAuthor.php',
        type: 'POST',
        data: { author },
        success: printResults
      });
    }
  });

  function printResults(response) {
    let books = JSON.parse(response);
    let template = '';

    books.forEach(task => {
      template += getTemplateCard(task);
    });
    $('#results-container').html(template);
  }

  function getTemplateCard(task) {
    return `
      <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <div class="card text-center overflow-hidden">
          <div class="ratio" style="--bs-aspect-ratio: 153%">
            <img src="uploads/${task.cover_url}" alt="Book cover">
          </div>
          <div class="card-body">
            <h5 class="card-title text-truncate">${task.title}</h5>
            <p class="card-text">${task.price}</p>
            <a href="?controller=books&action=getOne&isbn=${task.ISBN}" class="card-link">
              See details
            </a>
            <a href="?controller=books&action=edit&isbn=${task.ISBN}" class="card-link text-info"><i class="bi bi-pen"></i></a>
            <a href="?controller=books&action=delete&isbn=${task.ISBN}" class="card-link text-danger delete-link">
              <i class="bi bi-trash delete-link"></i>
            </a>
          </div>
        </div>
      </div>
    `;
  }
});