<?php
    $title = 'Administration';
   require_once 'db/conn.php';
   require_once 'includes/header.php';
   require_once 'includes/auth_check.php';

   if(isset($_POST['add-user'])
   &&!empty($_POST['firstname'])
   &&!empty($_POST['lastname'])
   &&!empty($_POST['username'])
   &&!empty($_POST['password'])){
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];  

    $result = $user->insertUser($fname,$lname,'admin',$username,$password);
    if($result){
        include 'includes/successmessage.php';

    } 
    else {
        include 'includes/errormessage.php';
    }
   }
   else if(isset($_POST['add-user'])
   &&(empty($_POST['firstname'])||empty($_POST['lastname'])||empty($_POST['username'])||empty($_POST['password']))
   ){
    echo '<div class="alert alert-danger text-center">Each field can not be empty.
    </div>';
   }

   if(isset($_POST['add-product'])){
    $name = $_POST['name'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $feature_id = $_POST['feature_id'];
    $p_result = $crud->insertProduct($name,$model,$manufacturer,$price,$stock,$feature_id);
    if($p_result){
      
        include 'includes/successmessage.php';
        header("Location: changelog.php?model=".$model);
    }else{
        include 'includes/errormessage.php';
    }
   }
   

?>


<h1 class="text-center my-5">ADMINISTRATION</h1>
<h2 class="container w-75">Current User: <?php echo $_SESSION['username']?></h2>
<?php if($_SESSION['role']=='manager') echo '<hr>'?>
<div class="container mt-5 w-75">
    <div <?php 
       if($_SESSION['role']=='admin'){
        echo 'style="display:none;"';
       }?>  
    >
        <h2 >Add New Admin User</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mx-auto">
        <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control "
                id="firstname"
                name="firstname"
                placeholder="firstname"
            
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
            
            />
            <label for="lastname" class="text-secondary"
                >Lastname</label
            >
            </div>
            <div class="form-floating mb-3 d-md-inline-block register-input">
                <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="username"
            
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
            <button type="submit" name="add-user" class="btn btn-md btn-warning mb-2 d-block">ADD</button>
        </form>
    
 <br>
 <br>   
<?php
    $results = $user->getUsers();
    
?>
    <h2 >Manage Admin User</h2>
    <table class="table table-striped table-bordered text-center mt-3">
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Username</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td>
                    <?php echo $r['user_id']?>
                </td>
                <td><?php echo $r['firstname']?></td>
                <td><?php echo $r['lastname']?></td>
                <td><?php echo $r['user_role']?></td>

                <td><?php echo $r['username']?></td>
                <td>
                    <a href="edit.php?id=<?php echo $r['user_id']?>" class="btn btn-success me-3">Edit</a>
                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>
<hr />
<div class="container mt-5 w-75">
    <h2 >Add New Product</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']).'#product'; ?>" method="post" class="mx-auto">
        <div class="form-floating mb-3 d-md-inline-block register-input">
            <input
                type="text"
                class="form-control "
                id="name"
                name="name"
                placeholder="name"
            
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
            />
            <label for="feature_id" class="text-secondary">Feature ID</label>
            </div>
            <button type="submit" name="add-product" class="btn btn-md btn-warning mb-3 d-block">ADD</button>
        </form>
    <?php 
        $r_product = $crud->getProducts();
    ?>
        <h2 class="mt-5">Manage Product</h2>
        <table class="table table-striped table-bordered text-center mt-3" id="product">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Model</th>
                <th>Manufacturer</th>
                <th>Price</th>
                <th>Stock On Hand</th>
                <th>Feature ID</th>    
                <th></th>    
            </tr>
        </thead>
        <tbody>
            <?php while($r = $r_product->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td>
                    <?php echo $r['product_id']?>
                </td>
                <td><?php echo $r['product_name']?></td>
                <td><?php echo $r['product_model']?></td>
                <td><?php echo $r['manufacturer']?></td>

                <td><?php echo $r['price']?></td>
                <td><?php echo $r['stock_on_hand']?></td>
                <td><?php echo $r['feature_id']?></td>
                <td>
                    <a href="edit.php?product_id=<?php echo $r['product_id']?>" class="btn btn-success me-3 mb-1">Edit</a>
                    <a href="delete.php?product_id=<?php echo $r['product_id']?>" class="btn btn-danger mb-1 hidden" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>    
</div>
<hr class="my-5"/>
<?php
 $r_log = $crud->getChangelogs();
?>
<div class="container mt-5 w-75" id="changlog">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']).'#changlog'; ?>" method="POST">
        <h2 class="mt-5 d-inline">Changelog</h2>
        <input class="btn btn-md btn-primary float-end mb-2" type="submit" value="Sort" name="submit_log">
        <table class="table table-striped table-bordered text-center mt-3">
        <thead>
            <tr>
                <th>Changelog ID</th>
                <th>Date Created
                <select class="form-select" name="date" aria-label="Sort by date">
                    <option>All</option>;
                    <?php 
                    $d_arr = array('1 day','3 days','7 days');
                    foreach($d_arr as $d){
                        if(isset($_POST['date']) && $_POST['date'] == $d) 
                    echo "<option  selected value='".$d."'>Within ".$d."</option>";
                    else echo "<option value='".$d."'>Within ".$d."</option>";}    
                    
                     $r_log_date= $crud->getChangelogDate();
                     $new_arr = array();
                     while($r = $r_log_date->fetch(PDO::FETCH_ASSOC)){ 
                         $date_arr = explode(" ",$r['date_created']);
                         $date_str = $date_arr[0];
                         if($date_str !== end($new_arr)){
                             array_push($new_arr,$date_str);
                         }
                         }                
                    foreach($new_arr as $date){   
                        if(isset($_POST['date']) && $_POST['date'] == $date){
                            echo '<option selected value="'.$date.'">'.$date.'</option>';  
                        }else echo '<option value="'.$date.'">'.$date.'</option>';                                              
                    } ?>
                    
                    
                </select>
                </th>
                <th>Date Last Modified</th>
                <th>User ID
                <select class="form-select" name="user" aria-label="Sort by user">
                    <option>All</option>
                    <?php
                    $r_log_user= $crud->getChangelogUserID();
                    while($r = $r_log_user->fetch(PDO::FETCH_ASSOC)){ 
                        $u_id = $r['user_id'];
                        if(isset($_POST['user']) && $_POST['user'] == $u_id){
                            echo '<option selected value="'.$u_id.'">'.$u_id.'</option>';  
                        }else echo '<option value="'.$u_id.'">'.$u_id.'</option>';                    
                    } ?>
                </select>
                </th>
                <th>Product ID
                <select class="form-select" name="product" aria-label="Sort by product">
                    <option>All</option>
                    <?php
                    $r_log_product= $crud->getChangelogProductID();
                    while($r = $r_log_product->fetch(PDO::FETCH_ASSOC)){ 
                        $p_id = $r['product_id'];
                        if(isset($_POST['product']) && $_POST['product'] == $p_id){
                            echo '<option selected value="'.$p_id.'">'.$p_id.'</option>';  
                        }else echo '<option value="'.$p_id.'">'.$p_id.'</option>';                
                    } ?>
                </select>
                </th>   
            </tr>
        </thead>
    </form>
        <tbody>
            <?php 
            if(!isset($_POST['date']) && !isset($_POST['user']) &&!isset($_POST['product']) 
            || ($_POST['date']==="All" && $_POST['user']==="All" && $_POST['product']==="All")
            ){
            while($r = $r_log->fetch(PDO::FETCH_ASSOC)){ 
                include 'includes/logtable.php';  }
            }else if(isset($_POST['product'])
              && $_POST['product'] !== 'All'){
               
                $product_id = $_POST['product'];
                $result = $crud->getChangelogsByProduct($product_id);
                foreach($result as $r){ include 'includes/logtable.php'; }
              }else if(isset($_POST['user'])
              && $_POST['user'] !== 'All'){
                $user_id = $_POST['user'];
                $result = $crud->getChangelogsByUser($user_id);
                foreach($result as $r){ include 'includes/logtable.php'; }
              }else if(isset($_POST['date'])
              && $_POST['date'] !== 'All'
              ){ 
                $date = $_POST['date'];
                if(strlen($_POST['date'])>6){
                $result = $crud->getChangelogsByDate($date);
            }else {
                $start = date("Y-m-d H:i:s",strtotime("-".$date));
                $end = date("Y-m-d H:i:s");
                $result = $crud->getChangelogsByDateRange($start,$end);
            }
            foreach($result as $r){ include 'includes/logtable.php'; }
                
              }
            ?>
        </tbody>
    </table> 
</div>

<br>
<br>
<br>
<br>
<br>
<?php
    require_once 'includes/footer.php';
?>