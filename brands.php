<?php
    if(isset($_GET['brand'])){
        $title = strtoupper($_GET['brand']);
    }else{
        $title = strtoupper($_GET['name']);
    }
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    
    if(isset($_GET['name'])){
        $result = $crud->getProductsByName($_GET['name']);
    }else if(!empty($_GET['brand'])){
      if($_GET['brand'] == 'other'){
        $result = $crud->getProductsByOther();
      }else{
         if(strtolower($_GET['brand']) == 'iphone') $_GET['brand'] = 'apple';
        $result = $crud->getProductsByBrand($_GET['brand']);
      }  
        if(!$result){
          header("Location: search.php?result=");
        }
    }else {
      header("Location: search.php");
    }

?>
 <div class="container">
      <h1 class="text-center mt-3"><?php echo $title;?></h1>
      <div class="container d-flex align-items-center">
        <h2 class="filter-title mb-0">FILTER BY</h2>
        <button class="btn btn-secondary btn-sm ms-3 btn-hide">
          <i class="bi bi-x"></i>Hide
        </button>
      </div>
      <div class="container">
        <button class="btn btn-sm btn-danger btn-filter">
          <i class="bi bi-funnel-fill me-2"></i>FILTER
        </button>
      </div>
    </div>
    <hr class='mb-0'/>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-6 filter-list-wrapper">
          <dl>
            <dt class="pt-3">CATEGORY</dt>
            <hr/>
            <dd>
              <ul class="list-group list-group-flush">
                <?php foreach($result as $r){?>
                <a class="category-list" href="brands.php?name=<?php echo strtolower($r['product_name']);?>"><li class="list-group-item"><?php 
                   $stock = $crud->getStockByProduct($r['product_model']);
                  echo $r['product_name'].' ('.$stock[0].')';?></li></a>
                <?php } ?>                
              </ul>
            </dd>
          </dl>
          <dl>
            <dt class="pt-3">PRICE</dt>
            <hr/>
            <dd>
              <ul class="list-group list-group-flush">
              <a class="category-list" href="price.php?min=0&max=999"><li class="list-group-item">Under $1000</li></a>
                <a class="category-list" href="price.php?min=1000&max=1499"><li class="list-group-item">$1000-$1500</li></a>
                <a class="category-list" href="price.php?min=1500&max=1999"><li class="list-group-item">$1500-$2000</li></a>
                <a class="category-list" href="price.php?min=2000&max=10000"><li class="list-group-item">$2000+</li></a>
              </ul>
            </dd>
          </dl>
        </div>
              
        <?php if(isset($_GET['name'])){
            $result = $crud->getProductsByName($_GET['name']);
            }else{
              if($_GET['brand'] == 'other'){
                $result = $crud->getProductsByOther();
              }else{
                $result = $crud->getProductsByBrand($_GET['brand']);
              }  
         }?>
        <div class="col-md-9 product-list-wrapper">
          <div class="container pt-3 ">
            <div class="row gy-3 justify-content-around">
              <?php foreach($result as $r){?>
              <div class="col">
                <div class="card border-0" style="width:260px">
                <a href="detail.php?id=<?php echo $r['product_id'];?>"><img src=<?php echo "images/".$r['product_model'].".jpeg";?> alt=<?php echo $r['product_name'];?> class="card-img-top"></a>
                  <div class="card-body">
                    <h3 class="card-title fs-6"><?php echo $r['product_name'];?></h3>
                    <p class="card-text text-danger">$<?php echo $r['price'];?> <span class="text-decoration-line-through ms-2 text-muted">$<?php 
                    $priceStr = str_replace(',','',$r['price']);
                    echo floatval($priceStr)+50;?></span></p>
                    <p class="card-text text-secondary" style="font-size:12px"><?php
                    if(intval($r['stock_on_hand'])>0) echo "✅ In Stock Dispatch in 1 ~ 2 business day.";
                    else echo "⛔️ Out of Stock.";
                    ?></p>
                    <a href="cart.php?add-id=<?php echo $r['product_id']?>" class="btn btn-danger">ADD TO CART <i class="bi bi-cart-plus-fill ps-1 fs-5"></i></a>
                  </div>
                </div>
              </div>
              <?php }?>
             
            </div>
          </div> 
        </div>
    </div>
</div>
<hr class="mt-0"/>
<br>
<br>
<br>
<br>
<br>
<?php
    require_once('includes/footer.php');
?>