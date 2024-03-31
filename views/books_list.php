<?php include 'partials/header.php'; ?>
<?php include 'partials/banner.php'; ?>
<div class="container">
  <h1>Our books</h1>
  <div class="row mt-3 row-gap-4">
    <?php foreach ($books as $book) : ?>
      <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <div class="card text-center overflow-hidden">
          <div class="ratio" style="--bs-aspect-ratio: 153%">
            <img src="uploads/<?= $book['cover_url']; ?>" alt="Book cover">
          </div>
          <div class="card-body">
            <h5 class="card-title text-truncate"><?= $book['title'] ?></h5>
            <p class="card-text"><?= '$' . number_format($book['price'], 2) ?></p>
            <a href="?controller=books&action=getOne&isbn=<?= $book['ISBN'] ?>" class="card-link">
              See details
            </a>
            <a href="?controller=books&action=edit&isbn=<?= $book['ISBN'] ?>" class="card-link text-info"><i class="bi bi-pen"></i></a>
            <a href="?controller=books&action=delete&isbn=<?= $book['ISBN'] ?>" class="card-link text-danger delete-link">
              <i class="bi bi-trash delete-link"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<script src="public/js/confirmDelete.js"></script>
<?php include 'partials/footer.php'; ?>