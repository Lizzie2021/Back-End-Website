<?php
  session_start();
  if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
  }
  date_default_timezone_set('Australia/Brisbane');
  if(!isset($_SESSION['count'])){
    $_SESSION['count']=0; 
    $_SESSION['cart_arr'] = array();
    $_SESSION['quantity_arr'] = array();
    }
  
    if(isset($_GET['add-id'])){
    if(!in_array($_GET['add-id'],$_SESSION['cart_arr'])){
      array_push($_SESSION['cart_arr'],$_GET['add-id']);
      if(isset($_GET['quantity'])){
        $_SESSION['count'] = $_SESSION['count'] + $_GET['quantity'];
        $_SESSION['quantity_arr'][$_GET['add-id']] = $_GET['quantity'];
      }else{
        $_SESSION['count'] = $_SESSION['count'] + 1;
        $_SESSION['quantity_arr'][$_GET['add-id']] = 1;
      }
    }else{
      echo'<script>alert("This item is already in your shopping cart.")</script>';
     
     }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/styles.css?<?php echo time(); ?>" />
    <title><?php echo $title?></title>
  </head>
  <body>
    <div class="nav-container sticky-top">
      <nav class="navbar top-nav-container">
        <div class="container">
          <a href="index.php" class="navbar-brand"
            ><img src="images/logo.png" class="logo" alt="logo"
          /></a>
          <?php
            if(isset($_SESSION['firstname'])
            && !isset($_SESSION['username'])){
              echo '<h1 class="text-light me-auto">Welcome,   '. $_SESSION['firstname']. '!</h1>';
            }
           
          ?>
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="d-flex" method="post">
           
            
            <a  href="search.php" class="text-decoration-none" style="color: white;
            font-size: 30px;"><i class="bi bi-search"></i></a>
          
            <a href="login.php">
              <i class="bi bi-person-circle login-btn"></i>
            </a>
            <a class="text-decoration-none" href="cart.php"><i class="bi bi-bag cart-btn"></i> <span  class="cart-count text-warning fw-bold" style="position: absolute;"><?php 
            echo $_SESSION['count'];
           ?></span></a>
            <?php
            if(isset($_SESSION['firstname'])
            || isset($_SESSION['username']))
            echo ' <button class="btn btn-danger btn-md ms-5 py-0" type="submit" name="logout" >
           Logout
            </button>';
            ?>  
          </form>
        </div>
      </nav>
      <nav class="navbar navbar-expand-sm nav-list-container">
        <button
          class="navbar-toggler"
          data-bs-toggle="collapse"
          data-bs-target="#nav-list"
          aria-controls="nav-list"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="bi bi-list navbar-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="nav-list">
          <ul class="navbar-nav w-75 mx-auto justify-content-between">
            <li class="nav-item">
              <a href="allphones.php" class="nav-link">Mobile Phones</a>
            </li>
            <li class="nav-item">
              <a href="brands.php?brand=apple" class="nav-link">iPhone</a>
            </li>
            <li class="nav-item">
              <a href="brands.php?brand=samsung" class="nav-link">Samsung</a>
            </li>
            <li class="nav-item">
              <a href="brands.php?brand=huawei" class="nav-link">Huawei</a>
            </li>
            <li class="nav-item">
              <a href="brands.php?brand=oppo" class="nav-link">Oppo</a>
            </li>
            <li class="nav-item">
              <a href="brands.php?brand=other" class="nav-link">Other</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>