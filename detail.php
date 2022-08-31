<?php
    $title = "Show Detail";
    require_once 'db/conn.php';
    require_once 'includes/header.php';

    if(isset($_GET['id'])){
      $product_id = $_GET['id'];
      $result = $crud->getProductById($product_id);
      $r = $crud->getFeaturesByProductId($product_id);
    }else{
      header("Location: allphones.php");
    }

    
    
?>
 <div class="container mt-5 w-75">
      <div class="row">
        <div class="col-md-6 detail-image text-center">
          <img
            src="images/<?php echo $result['product_model']?>.jpeg"
            alt="samsung"
            class="fluid"
          />
        </div>
        <div class="col-md-6 detail-description">
          <div class="card border-0">
            <div class="card-body">
              <h2 class="card-title">
              <?php echo $result['product_name'];?>
              </h2>
              <p class="card-text text-danger fs-5 fw-bold">
                $<?php echo $result['price']?><span
                  class="text-muted text-decoration-line-through ms-3 fs-6 fw-normal"
                  >$<?php echo floatval($result['price'])+50?></span
                >
              </p>
              
              <p class="card-text float-start me-3 mt-1">Quantity:</p>
              <input
                type="number"
                name="quantity"
                class="form-control border-secondary"
                placeholder="1"
                value = 1
                aria-label="quantity"
                style="width: 60px"
                min="1"
                max="9"
              />
              <p class="card-text stock-description">
              <?php
                    if(intval($result['stock_on_hand'])>0) echo "✅ In Stock. Dispatch in 1 ~ 2 business day.";
                    else echo "⛔️ Out of Stock."
                    ?>
              </p>
              <a href="cart.php?add-id=<?php echo $product_id?>" class="btn btn-success detail-btn-cart" 
                >ADD TO CART <i class="bi bi-cart-plus-fill ps-1 fs-5"></i
              ></a>
             
            </div>
          </div>
          <hr />
          <dl class="features">
            <dt>FEATURES</dt>
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-0">
                <?php echo $result['product_name'].'are breaking the rules of video. Setting the standard at being our most epic smartphone series'?>
              </li>
              <li class="list-group-item border-0">
                ✅ <?php echo $r['screensize'];?> BrightVision display
              </li>
              <li class="list-group-item border-0">
                ✅ <?php echo $r['rear_camera']?> camera - with new Adaptive Pixel Technology.
              </li>
              <li class="list-group-item border-0">
                ✅ <?php echo $r['battery']?> All Day Battery
              </li>
             
            </ul>
          </dl>
        </div>
      </div>
    </div>
    <hr class="mb-5" />
    <div class="container">
      <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active text-success"
            id="specification-tab"
            data-bs-toggle="tab"
            data-bs-target="#specification"
            type="button"
            role="tab"
            aria-controls="specification"
            aria-selected="true"
          >
            SPECIFICATION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link text-success"
            id="inbox-tab"
            data-bs-toggle="tab"
            data-bs-target="#inbox"
            type="button"
            role="tab"
            aria-controls="inbox"
            aria-selected="false"
          >
            IN THE BOX
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link text-success"
            id="delivery-tab"
            data-bs-toggle="tab"
            data-bs-target="#delivery"
            type="button"
            role="tab"
            aria-controls="delivery"
            aria-selected="false"
          >
            DELIVERY
          </button>
        </li>
      </ul>
      <div class="tab-content mt-5" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="specification"
          role="tabpanel"
          aria-labelledby="specification-tab"
        >
          <table class="table table-borderless">
            <tbody>
              <tr>
                <th class="text-end border-end pe-3 w-50">Weight</th>
                <td class="ps-3"><?php echo $r['weight'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Dimensions</th>
                <td class="ps-3"><?php echo $r['dimensions'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">OS</th>
                <td class="ps-3"><?php echo $r['OS'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Screensize</th>
                <td class="ps-3"><?php echo $r['screensize'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Resolution</th>
                <td class="ps-3"><?php echo $r['resolution'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">CPU</th>
                <td class="ps-3"><?php echo $r['CPU'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">RAM</th>
                <td class="ps-3"><?php echo $r['RAM'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Storage</th>
                <td class="ps-3"><?php echo $r['storage'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Battery</th>
                <td class="ps-3"><?php echo $r['battery'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Rear Camera</th>
                <td class="ps-3"><?php echo $r['rear_camera'];?></td>
              </tr>
              <tr>
                <th class="text-end border-end pe-3">Front Camera</th>
                <td class="ps-3"><?php echo $r['front_camera'];?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div
          class="tab-pane fade"
          id="inbox"
          role="tabpanel"
          aria-labelledby="inbox-tab"
        >
          <ul class="list-group list-group-flush">
            <li class="list-group-item border-0">
             
              <?php echo $result['product_name'].'( '.$r['screensize'].', '.$r['storage'].'/'.$r['RAM'].', '.$r['rear_camera'].' Camera, '.$result['product_model'].' )'?>
            </li>
            <li class="list-group-item border-0">Cable</li>
            <li class="list-group-item border-0">Ejection Pin</li>
            <li class="list-group-item border-0">Quick Start Guide</li>
          </ul>
        </div>
        <div
          class="tab-pane fade"
          id="delivery"
          role="tabpanel"
          aria-labelledby="delivery-tab"
        >
          <dl>
            <dt>SHIPPING</dt>
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-0">
                Free Shipping for all orders over $100 for members
              </li>
              <li class="list-group-item border-0">
                Standard shipping cost from $7.80 for members
              </li>
              <li class="list-group-item border-0">
                Orders will be processed within 1-2 business days when full
                payment is received and confirmed by our bank. Please allow 2 -
                7 business days for the items to be delivered.
              </li>
            </ul>
          </dl>
        </div>
      </div>
    </div>
    <br>
    
   

<?php
    require_once('includes/footer.php');
?>