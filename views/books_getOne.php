<?php include 'partials/header.php'; ?>
<div class="container mt-5">
  <div class="row g-5">
    <div class="col-12 col-md-3 col-lg-4">
      <img src="uploads/<?= $book['cover_url']; ?>" alt="Book cover" class="img-fluid w-100">
    </div>
    <div class="col-12 col-md-9 col-lg-8">
      <h1 class="display-5"><?= $book['title']; ?></h1>
      <p class="text-body-tertiary mb-0">ISBN <?= $book['ISBN']; ?></p>
      <p class="text-body-secondary fs-5">By <?= $book['author']; ?> (<?= $book['year']; ?>)</p>
      <p class="mb-5"><?= $book['description']; ?></p>
      <div class="mb-4">
        <a href="?controller=books&action=edit&isbn=<?= $book['ISBN']; ?>" class="btn btn-info me-1">
          <i class="bi bi-pen"></i> Edit
        </a>
        <a href="?controller=books&action=delete&isbn=<?= $book['ISBN']; ?>" class="btn btn-danger delete-link">
          <i class="bi bi-trash"></i> Delete
        </a>
      </div>
      <button class="btn btn-primary btn-lg">
        Buy:
        <?= '$' . number_format($book['price'], 2); ?>
      </button>
    </div>
  </div>
</div>
<script src="public/js/confirmDelete.js"></script>
<?php include 'partials/footer.php'; ?>