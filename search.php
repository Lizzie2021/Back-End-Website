<?php
    $title = "Search";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    if(isset($_GET['result']) && empty($_GET['result'])){
      echo'<div class="alert alert-danger text-center">No result found.
      </div>';
    }
?>
<div class="container text-center w-50 mx-auto mt-5">
      <form class="mb-5" action="brands.php" method="get">
        <h1 class="mb-5">SEARCH</h1>

        <div class="form-floating d-md-inline-block search-input mb-3">
          <input
            type="text"
            class="form-control"
            id="search"
            placeholder="search"
            name="brand"
          />
          <label for="search" class="text-secondary"
            >Apple, Samsung, Huawei... </label
          >
        </div>
        <button
          class="btn btn-lg d-md-inline-block btn-search"
          type="submit"
          style="background-color: #63388b; color: white"
        >
          SEARCH
        </button>
      </form>
    </div>
  <br>
  <br>
  <br>
  <br>
  <br>
<?php
    require_once('includes/footer.php');
?>