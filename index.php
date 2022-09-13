<?php
    $title = "Mobile Hour";
//     require_once 'db/conn.php';
    require_once 'includes/header.php';
?>
 <div class="home-slide">
      <a href="brands.php?brand=samsung">
        <img src="images/home-slide.jpeg" alt="banner" class="img-fluid" />
      </a>
    </div>
    <div class="images-container">
      <div class="container">
        <h1 class="subtitle">Shop By Popular Categories</h1>
        <div class="d-lg-flex justify-content-between">
          <a href="brands.php?brand=apple"
            ><img
              src="images/banner-iphone.png"
              alt="iphone"
              class="banner-image"
          /></a>
          <a href="brands.php?brand=samsung">
            <img
              src="images/banner-samsung.png"
              alt="samsung"
              class="banner-image pe-1 pb-2"
          /></a>
          <a href="brands.php?brand=huawei"
            ><img
              src="images/banner-huawei.png"
              alt="huawei"
              class="banner-image"
          /></a>
          <a href="brands.php?brand=oppo"
            ><img src="images/banner-oppo.png" alt="oppo" class="banner-image"
          /></a>
        </div>
      </div>
    </div>
<?php
    require_once('includes/footer.php');
 ?>
