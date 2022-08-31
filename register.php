<?php
    $title = "Register";
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    if(isset($_POST['submit'])){
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $lname = $_POST['lastname'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $postcode = $_POST['postcode'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $password = $_POST['password'];
      $re_password = $_POST['re_password'];

      if($password!==$re_password){
        echo '<div class="alert alert-danger text-center">Two Passwords are different! 
        </div>';
      }else{
        $isSuccess = $crud->insertCustomer($fname,$lname,$phone,$email,$address,$postcode,$city,$state,$password);
      
      if($isSuccess){
        header("Location:login.php?email=".$_POST['email']);
      }else{
        include 'includes/errormessage.php';
      }
      }
    }
?>
 <div class="container text-center w-75 mt-4">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
        <h1 class="mb-4">CREATE AN ACCOUNT</h1>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="text"
            class="form-control"
            id="firstname"
            name="firstname"
            placeholder="First Name"
          />
          <label for="firstname" class="text-secondary label-email"
            >First Name</label
          >
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="text"
            class="form-control"
            id="lastname"
            name="lastname"
            placeholder="Last Name"
          />
          <label for="lastname" class="text-secondary">Last Name</label>
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="email"
          />
          <label for="email" class="text-secondary">Email</label>
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="text"
            class="form-control"
            id="phone"
            name="phone"
            placeholder="phone"
          />
          <label for="phone" class="text-secondary">Phone</label>
        </div>
        <div
          class="form-floating mb-2 d-md-inline-block register-input-address"
        >
          <input
            type="text"
            class="form-control"
            id="address"
            name="address"
            placeholder="address"
          />
          <label for="address" class="text-secondary">Address</label>
        </div>
        <div
          class="form-floating mb-2 d-md-inline-block register-input-postcode"
        >
          <input
            type="text"
            class="form-control"
            id="postcode"
            name="postcode"
            placeholder="postcode"
          />
          <label for="postcode" class="text-secondary">Post Code</label>
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="text"
            class="form-control"
            id="city"
            name="city"
            placeholder="city"
          />
          <label for="city" class="text-secondary">City</label>
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="text"
            class="form-control"
            id="state"
            name="state"
            placeholder="state"
          />
          <label for="state" class="text-secondary">State</label>
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="password"
          />
          <label for="password" class="text-secondary">Password</label>
        </div>
        <div class="form-floating mb-2 d-md-inline-block register-input">
          <input
            type="password"
            class="form-control"
            id="re-password"
            name="re_password"
            placeholder="password"
          />
          <label for="re-password" class="text-secondary"
            >Confirm Password</label
          >
        </div>

        <button
          class="btn btn-lg my-5 btn-register"
          type="submit"
          name="submit"
          style="background-color: #63388b; color: white"
        >
          CREATE ACCOUNT
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