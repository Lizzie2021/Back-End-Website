<?php
    $title = 'Edit';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'db/conn.php';

    if(!isset($_GET['id'])
        && !isset($_GET['product_id'])){
         include 'includes/errormessage.php';
        header('Location:administration.php');
        


    }else{
      if(isset($_GET['id'])){
       $id = $_GET['id'];
       $result =  $user->getUserDetails($id);
        
?>

<div class="container mt-5 w-75">
    <h1 class="text-center">EDIT ACCOUNT</h1>
        
        <form action="editpost.php" method="post" class="mx-auto">
        <input type="hidden" name="user_id" value="<?php echo $result['user_id']?>">
        <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control "
                id="firstname"
                name="firstname"
                placeholder="firstname"
                value="<?php echo $result['firstname']?>"
            
            />
            <label for="firstname" class="text-secondary label-email"
                >Firstname</label
            >
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
                <input
                type="text"
                class="form-control"
                id="lastname"
                name="lastname"
                placeholder="lastname"
                value="<?php echo $result['lastname']?>"
            />
            <label for="lastname" class="text-secondary"
                >Lastname</label
            >
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
                <input
                type="text"
                class="form-control"
                id="role"
                name="role"
                placeholder="role"
                value="<?php echo $result['user_role']?>"
            />
            <label for="role" class="text-secondary"
                >Role</label
            >
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
                <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="username"
                value="<?php echo $result['username']?>"
            />
            <label for="username" class="text-secondary"
                >Username</label
            >
            </div>
            
            <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Password"
                
            />
            <label for="password" class="text-secondary">Password</label>
            </div>
            <button type="submit" name="submit" class="btn btn-md btn-warning mb-3 d-block">SAVE</button>
        </form>
    
</div>

<?php }else if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $r_product = $crud->getProductDetails($product_id);
?>
    <div class="container mt-5 w-75">
    <h1 class="text-center">EDIT PRODUCT</h1>
 <form action="editpost.php" method="post" class="mx-auto">
        <input type="hidden" name="product_id" value="<?php echo $r_product['product_id']?>">
        <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control "
                id="name"
                name="name"
                placeholder="name"
                value="<?php echo $r_product['product_name']?>"
            
            />
            <label for="name" class="text-secondary label-email"
                >Name</label
            >
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
                <input
                type="text"
                class="form-control"
                id="model"
                name="model"
                placeholder="model"
                value="<?php echo $r_product['product_model']?>"
            
            />
            <label for="model" class="text-secondary"
                >Model</label
            >
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
                <input
                type="text"
                class="form-control"
                id="manufacturer"
                name="manufacturer"
                placeholder="manufacturer"
                value="<?php echo $r_product['manufacturer']?>"
            
            />
            <label for="manufacturer" class="text-secondary"
                >Manufacturer</label
            >
            </div>
            
            <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control"
                id="price"
                name="price"
                placeholder="price"
                value="<?php echo $r_product['price']?>"
            />
            <label for="price" class="text-secondary">Price</label>
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control"
                id="stock"
                name="stock"
                placeholder="stock"
                value="<?php echo $r_product['stock_on_hand']?>"
            />
            <label for="stock" class="text-secondary">Stock On Hand</label>
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control"
                id="feature_id"
                name="feature_id"
                placeholder="feature_id"
                value="<?php echo $r_product['feature_id']?>"
            />
            <label for="feature_id" class="text-secondary">Feature ID</label>
            </div>
            <button type="submit" name="submit_product" class="btn btn-md btn-warning mb-3 d-block">SAVE</button>
        </form>





<?php } }?>


<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>