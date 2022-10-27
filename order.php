<?php
    $title = "Order";
    require_once 'db/conn.php';
    require_once 'includes/header.php';   
    
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }else{
        $email = $_SESSION['email'];
        $r = $crud->getCustomerIdByEmail($email);
        $user_id = $customer_id = $r['customer_id'];
        $delivery_date = date("Y-m-d",strtotime("+2 days"));
        $result = $crud->inserOder($delivery_date,$user_id,$customer_id);
    }     
?>
<div class="alert alert-success text-center">Congratulations! Your order has been made successfully.
</div>
<h1 class="text-center my-5">ORDER DETAILS</h1>
<div class="container mt-5 w-75">
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Order Delivery Date</th>
                <th>Customer Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result){
         
            $products_id = $_SESSION['cart_arr'];
            
            foreach($products_id as $product_id){
                $product = $crud->getProductDetails($product_id);
                $product_name = $product['product_name'];
                $quantity = $_SESSION['quantity_arr'][$product_id];             
                $price_sold = floatval($product['price']) * intval($quantity);
                $r_order = $crud->getLastOrderNumber();
                $order_number = $r_order['order_number'];
                $r_insert_order_detail = $crud->inserOrderDetail($product_id, $quantity,$price_sold,$order_number);
                
                if ($r_insert_order_detail){ ?>

                    <tr>
                        <td><?php echo $order_number;?></td>
                        <td><?php echo $product_name;?></td>
                        <td><?php echo $quantity;?></td>
                        <td><?php echo $price_sold;?></td>
                        <td><?php echo $delivery_date;?></td>
                        <td><?php echo $email;?></td>
                    </tr>
 
           <?php } } }?>
            
        </tbody>
    </table>
</div>
<br>
<br>
<br>
<br>
<br>
<?php
    if($result){
        $_SESSION['count']=0; 
        $_SESSION['cart_arr'] = array();
        $_SESSION['quantity_arr'] = array();
        
        }
    require_once('includes/footer.php');
?>