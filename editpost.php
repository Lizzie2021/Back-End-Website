<?php
   
   require_once 'db/conn.php';
   require_once 'includes/header.php';
   require_once 'includes/auth_check.php';
   if(isset($_POST['submit'])
   &&!empty($_POST['firstname'])
   &&!empty($_POST['lastname'])
   &&!empty($_POST['username'])
   &&!empty($_POST['password'])){
    $id = $_POST['user_id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $user_role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];  

    $result = $user->editUser($id,$fname,$lname,$user_role,$username,$password);
    if($result){
         header("Location: administration.php");
    } 
    else {
        include 'includes/errormessage.php';
       
    }
   
   }
   else if(isset($_POST['submit'])
   &&(empty($_POST['firstname'])||empty($_POST['lastname'])||empty($_POST['username'])||empty($_POST['password']))
   ){
    echo '<div class="alert alert-danger text-center">Each field can not be empty.
    </div>';
   ?>
   <a href="edit.php?id=<?php echo $_POST['user_id']?>" class="btn btn-primary d-block mx-auto w-25">Back To Edit</a>

  <?php }   
  
  if(isset($_POST['submit_product'])){
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $feature_id = $_POST['feature_id'];

    $result = $crud->editProduct($product_id, $name,$model,$manufacturer,$price,$stock,$feature_id);

    if($result){
        header("Location: changelog.php?product_id=".$product_id);     
    } 
    else {
        include 'includes/errormessage.php';
        
    }
  }
  
  
  ?>


<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>