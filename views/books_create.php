<?php include 'partials/header.php'; ?>
<div class="container mt-5">
  <h1 class="text-center">Insert a new book</h1>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
      <i class="bi bi-x-circle me-2"></i>
      <?= $error ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>
  <form action="?controller=books&action=create" method="post" enctype="multipart/form-data">
    <div class="row g-3 mb-3">
      <div class="col-12 col-md-3 col-xl-2">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn" maxlength="17" required placeholder="###-#-##-######-#">
      </div>
      <div class="col-12 col-md-5 col-lg-6 col-xl-7">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" maxlength="64" required>
      </div>
      <div class="col-12 col-md-4 col-lg-3">
        <label for="author" class="form-label">Author(s)</label>
        <input type="text" class="form-control" id="author" name="author" maxlength="64">
      </div>
      <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
      </div>
      <div class="col-12 col-sm-6 col-md-3 col-lg-2">
        <label for="price" class="form-label">Price</label>
        <div class="input-group">
          <span class="input-group-text">$</span>
          <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="0.0" min="0" id="price" name="price">
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-3 col-lg-2">
        <label for="year" class="form-label">Year of publication</label>
        <input type="number" class="form-control" placeholder="2000" min="0" max="2024" id="year" name="year" required>
      </div>
      <div class="col-12 col-md-6 col-lg-8">
        <label for="coverURL" class="form-label">Cover</label>
        <input class="form-control" type="file" accept="image/*" id="coverURL" name="cover_url">
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg d-block ms-auto">
      <i class="bi bi-send"></i>
      Submit
    </button>
  </form>
</div>
<?php include 'partials/footer.php'; ?>