<?php
    $title = "Shopping Cart";
    require_once 'db/conn.php';
    require_once 'includes/header.php';   
    if(isset($_GET['delete'])){
      $_SESSION['cart_arr'] = array_filter($_SESSION['cart_arr'], function($el){
          return $el !== $_GET['delete'];
        });
        $_SESSION['count'] = count($_SESSION['cart_arr']);
        header("Location: cart.php");
    } 
   if(isset($_GET['order'])){
      if($_GET['order'])
      header("Location: order.php");
      else echo '<div class="alert alert-danger text-center">No item in your shopping cart.</div>';}
?>

 <div class="container ">
      <h1 class="text-center my-5">SHOPPING CART</h1>
      <table class="table w-75 mx-auto">
        <thead class="table-light">
          <tr>
            <th scope="col">Item</th>
            <th scope="col" class="first-row-price">Price</th>
            <th scope="col">Qty</th>
            <th scope="col"class="first-row-price">Subtotal</th>
            <th></th>
          </tr>
          <tbody>
      <?php
          $products_id = $_SESSION['cart_arr'];
          foreach($products_id as $product_id){
            if(isset($_POST['quantity_'.$product_id])){
              $_SESSION['quantity_arr'][$product_id] = $_POST['quantity_'.$product_id] ;}
            $result = $crud->getProductById($product_id);
            $r = $crud->getFeaturesByProductId($product_id);?>
            <tr>
                <td>
                <a href="detail.php?id=<?php echo $product_id;?>"><img src="images/<?php echo $result['product_model']?>.jpeg"
                    style="width: 100px" class="float-start"></a>
                    <p style="font-size: 14px"><?php echo $result['product_name'].'( '.$r['screensize'].', '.$r['storage'].'/'.$r['RAM'].', '.$r['rear_camera'].' Camera, '.$result['product_model'].' )'?></p>
                    <p class="hidden-price text-danger" style="font-size: 14px; ">$<?php echo $result['price']?></p>
                </td>
                <td class="first-row-price" style="font-size: 14px"> $<?php echo $result['price']?></td>
        <form action="cart.php" method="POST">
                  <td>
                      <input
                        type="number"
                        name="quantity_<?php echo $product_id;?>"
                        class="form-control border-secondary"
                        placeholder="1"
                        value = "<?php echo $_SESSION['quantity_arr'][$product_id];?>"
                        aria-label="quantity"
                        style="width: 55px;height: 25px;"
                        min="1"
                        max="9"
                      />
                  </td>
                  <td class="first-row-price" style="font-size: 14px" >$<?php echo floatval($result['price']) * floatval($_SESSION['quantity_arr'][$product_id]); ?></td>
                  <td><a href="cart.php?delete=<?php echo $product_id?>" role="button" class="link-danger"><i class="bi bi-x-circle-fill"></i></a></td>
              </tr>
          <?php } ?> 
            </tbody>
          </thead>
        </table>
    
        <div class="mx-auto mt-2 w-75 cart-btn-wrapper d-lg-flex justify-content-between ">
          <button class="btn btn-success mt-2"><a class="text-decoration-none text-light" href="index.php">CONTINUE SHOPPING</a></button>
          <button class="btn btn-success mt-2" type="submit">UPDATE CART</button>
          <button class="btn btn-success mt-2" ><a class="text-decoration-none text-light" href="cart.php?order=<?php if(!$_SESSION['count']) echo 0; else echo 1;?>">MARK AN ORDER</a></button>
          
        </div>   
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