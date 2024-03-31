<?php include 'partials/header.php'; ?>
<div class="container mt-5">
  <h1 class="text-center">Search your favorite book</h1>
  <div class="row mt-4">
    <div class="col-12 col-md-4 col-lg-3">
      <h2 class="mb-3">
        <i class="bi bi-filter-right"></i>
        Filters
      </h2>
      <div>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control" placeholder="Title" id="input-title">
          <button class="btn btn-outline-primary" id="btn-title">
            <i class="bi bi-arrow-right-short"></i>
          </button>
        </div>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control" placeholder="ISBN" id="input-isbn" maxlength="17">
          <button class="btn btn-outline-primary" id="btn-isbn">
            <i class="bi bi-arrow-right-short"></i>
          </button>
        </div>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control" placeholder="Author" id="input-author">
          <button class="btn btn-outline-primary" id="btn-author">
            <i class="bi bi-arrow-right-short"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8 col-lg-9">
      <h2>Results</h2>
      <div class="row row-gap-4" id="results-container"></div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="public/js/filters.js"></script>
<?php include 'partials/footer.php'; ?>