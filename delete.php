<?php
    $title = 'Delete Account';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'db/conn.php';

    if(!isset($_GET['id'])
    && !isset($_GET['product_id'])){
        include 'includes/errormessage.php';
        header("Location: administration.php");
    }else{

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = $user->deleteUser($id);

            if($result){
                header("Location: administration.php");

            }else{
                include 'includes/errormessage.php';
            }  
        }else if(isset($_GET['product_id'])){
            $product_id = $_GET['product_id'];
            $r_product = $crud->deleteProduct($product_id);
            if($r_product){
                header("Location: administration.php#product");  

            }else{
                include 'includes/errormessage.php';
            }  
        } 
       
    }
?>