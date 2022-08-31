<?php
    $title = "Login";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    
    if(isset($_GET['email'])){
      echo '<div class="alert alert-success text-center">You have been registered successfully.Please login!
      </div>';
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $username_email = strtolower(trim($_POST['username/email']));
      $password = $_POST['password'];
      $isEmail = filter_var($username_email,FILTER_VALIDATE_EMAIL);
      if($isEmail){
        $result = $crud->getCustomer($username_email,$password);
        if(!$result){
          echo '<div class="alert alert-danger text-center">Username or Password is incorrect! Please try again.</div>';
        } else {
          $_SESSION['email'] = $username_email;
          $_SESSION['firstname']=$result['firstname'];
          $_SESSION['customer_id']=$result['customer_id'];
          header("Location: allphones.php");
        }
      }else{
        $result = $user->getUser($username_email,$password);
        if(!$result){
          echo '<div class="alert alert-danger text-center">Username or Password is incorrect! Please try again.</div>';
        } else {
          $_SESSION['username'] = $username_email;
          $_SESSION['role'] = $result['user_role'];
          $_SESSION['user_id']=$result['user_id'];
          header("Location: administration.php");
        }
      }
      
      
    }

?>
<div class="container text-center w-50 mx-auto mt-5">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <h1 class="mb-5">LOGIN</h1>
        <div class="form-floating mb-5">
          <input
            type="text"
            class="form-control"
            id="username/email"
            name="username/email"
            placeholder="username/name@example.com"
            value="<?php 
            if($_SERVER['REQUEST_METHOD']=='POST') echo $_POST['username/email']
            ?>"
          />
          <label for="username/email" class="text-secondary label-email"
            >Admin Username / Customer Email</label
          >
        </div>
        <div class="form-floating mb-5">
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Password"
          />
          <label for="password" class="text-secondary">Password</label>
        </div>
        <button
          class="w-100 btn btn-lg mb-5"
          type="submit"
          style="background-color: #63388b; color: white"
        >
          LOGIN
        </button>
      </form>
      <div class="mb-5">
        <a href="register.php" class="text-success text-decoration-none"
          >CREATE AN ACCOUNT</a
        >
      </div>
    </div>
<br>
<br>
<br>
<br>
<br>
<?php
    require_once('includes/footer.php');
?>