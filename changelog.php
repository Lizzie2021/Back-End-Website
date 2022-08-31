<?php
    require_once 'db/conn.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    if(isset($_GET['model'])){

        $date_created = date("Y-m-d H:i:s");
        $user_id = $_SESSION['user_id'];
        $date_last_modified = 'New Added';
        $model = $_GET['model'];
        $r = $crud->getProductByModel($model);
        $product_id = $r['product_id'];
        $result = $crud->insertChangelog($date_created, $date_last_modified,$user_id,$product_id);

        if($result){
            header("Location: administration.php");
        }else{
            include "includes/errormessage.php";
        }
    }

    if(isset($_GET['product_id'])){
          $product_id = $_GET['product_id'];
          $date_created = date("Y-m-d H:i:s");
          $user_id = $_SESSION['user_id'];
          $r = $crud->getLastModifiedDate($product_id);
          $date_last_modified = $r['date_created'];
          $result = $crud->insertChangelog($date_created, $date_last_modified,$user_id,$product_id);
        if($result){
            header("Location: administration.php");
        }else{
            include "includes/errormessage.php";
        }

    }


    
?>

<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>