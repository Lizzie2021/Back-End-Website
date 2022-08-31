<?php
    class Crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }
        
        public function insertCustomer ($fname,$lname,$phone,$email,$address,$postcode,$city,$state,$password)
        {   try{
            $result = $this->getCustomerbyemail($email);
            if($result['num']>0){
                return false;
            }else{
                $hashed_password = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `customer`(`firstname`, `lastname`, `cust_phone`, `cust_email`, `cust_address`, `postcode`, `city`, `state`,`cust_password`) VALUES (:fname,:lname,:phone,:email,:address,:postcode,:city,:state,:hashed_password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':fname',$fname);
            $stmt->bindValue(':lname',$lname);
            $stmt->bindValue(':phone',$phone);
            $stmt->bindValue(':email',$email);
            $stmt->bindValue(':address',$address);
            $stmt->bindValue(':postcode',$postcode);
            $stmt->bindValue(':city',$city);
            $stmt->bindValue(':state',$state);
            $stmt->bindValue(':hashed_password',$hashed_password);

            $stmt->execute();
            return true;
        }}catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    
    } 
    
    public function getCustomerbyemail($email){
        try{
            $sql = "select count(*) as num from customer where cust_email=:email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email',$email);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getCustomer($email,$password){
        try {
            $sql = "select * from customer where cust_email = :email ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email',$email);
            $stmt->execute();
            $result = $stmt->fetch();
            
            if(password_verify($password,$result['cust_password'])){
                return $result;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertProduct($name,$model,$manufacturer,$price,$stock,$feature_id){
        try{
           $r = $this->getProductsByModel($model);
           if($r['num']>0){
            return false;
           }else{
            $sql = "INSERT INTO `product`( `product_name`, `product_model`, `manufacturer`, `price`, `stock_on_hand`, `feature_id`) VALUES (:name, :model, :manufacturer, :price, :stock, :feature_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name',$name);
            $stmt->bindValue(':model',$model);
            $stmt->bindValue(':manufacturer',$manufacturer);
            $stmt->bindValue(':price',$price);
            $stmt->bindValue(':stock',$stock);
            $stmt->bindValue(':feature_id',$feature_id);

            $stmt->execute();
            return true;
           }
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getProductsByModel($model){
        try{
            $sql = "select count(*) as num from product where product_model = :model";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':model',$model);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getProducts(){
        try{
            $sql = "select * from product";
            $result = $this->db->query($sql);
            return $result;   
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getProductDetails($id){
        try{
            $sql = "select * from product where product_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function editProduct($id, $name,$model,$manufacturer,$price,$stock,$feature_id){
        try{
            $sql = "UPDATE `product` SET `product_name`=:name,`product_model`=:model,`manufacturer`= :manufacturer,`price`= :price,`stock_on_hand`=:stock,`feature_id`=:feature_id WHERE `product_id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->bindValue(':name',$name);
            $stmt->bindValue(':model',$model);
            $stmt->bindValue(':manufacturer',$manufacturer);
            $stmt->bindValue(':price',$price);
            $stmt->bindValue(':stock',$stock);
            $stmt->bindValue(':feature_id',$feature_id);
            
            $stmt->execute();
            return true;

        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteProduct($id){
        try{
            $sql = "DELETE FROM `product` WHERE product_id=:id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertChangelog($date_changed, $date_last_modified,$user_id,$product_id){
        try{
            $sql = "INSERT INTO `changelog`(`date_created`, `date_last_modified`, `user_id`, `product_id`) VALUES (:date_changed, :date_last_modified, :user_id,:product_id)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':date_changed',$date_changed);
            $stmt->bindValue(':date_last_modified',$date_last_modified);
            $stmt->bindValue(':user_id',$user_id);
            $stmt->bindValue(':product_id',$product_id);

            $stmt->execute();
            return true;            
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getLastModifiedDate($product_id){
        try{
            $sql = "SELECT * FROM changelog WHERE product_id = :product_id ORDER BY changelog_id DESC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_id',$product_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;

        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getProductByModel($model){
        try{
            $sql = "select * from product where product_model = :model";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':model',$model);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getChangelogs(){
        try{
            $sql = "select * from changelog";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getProductsByBrand($manufacturer){
        try{
            $sql = "select * from product where manufacturer = :manufacturer";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':manufacturer',$manufacturer);
            $stmt->execute();
            $result = $stmt->fetchAll();
             return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getProductsByName($product_name){
        try{
            $sql = "select * from product where product_name = :product_name";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_name',$product_name);
            $stmt->execute();
            $result = $stmt->fetchAll();
             return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getProductsByPrice($price_min,$price_max){
        try{
            $sql = "SELECT * FROM product
            WHERE price >= $price_min AND price <= $price_max";
            $result = $this->db->query($sql)->fetchAll();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getStockByProduct($model){
        try{
            $sql = "select stock_on_hand from product where product_model = :model";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':model',$model);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getStockByBrand($manufacturer){
        try{
            $sql = "select SUM(stock_on_hand) as sum from product where manufacturer = :manufacturer";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':manufacturer',$manufacturer);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getBrands(){
        try{
            $sql = "select distinct manufacturer from product";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
   
    public function getChangelogProductID(){
        try{
            $sql = "select distinct product_id from changelog ";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getChangelogUserID(){
        try{
            $sql = "select distinct user_id from changelog ";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getChangelogDate(){
        try{
            $sql = "select distinct date_created from changelog ";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getChangelogsByProduct($product_id){
        try{
            $sql = "select * from changelog where product_id = :product_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_id',$product_id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getChangelogsByUser($user_id){
        try{
            $sql = "select * from changelog where user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':user_id',$user_id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getChangelogsByDate($date){
        try{
            $pattern = $date.'%';
            $sql = "SELECT * FROM `changelog` WHERE `date_created` LIKE :pattern";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':pattern',$pattern);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getChangelogsByDateRange($start,$end){
        try{            
            $sql = "SELECT * FROM `changelog` WHERE `date_created` BETWEEN :start AND :end";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':start',$start);
            $stmt->bindValue(':end',$end);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getProductById($product_id){
        try{
            $sql = "select * from product where product_id = :product_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_id',$product_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getFeaturesByProductId($product_id){
        try{
            $sql = "SELECT feature.weight,feature.dimensions,feature.OS,feature.screensize,feature.resolution,feature.CPU,feature.RAM,feature.storage,feature.battery,feature.rear_camera,feature.front_camera,product.product_id FROM feature INNER JOIN product ON product.feature_id = feature.feature_id   WHERE product.product_id = :product_id ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_id',$product_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
       
    }

    public function getProductsByOther(){
        try{
            $sql = "select * from product where manufacturer not in ('Apple','Samsung','Huawei','Oppo')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function inserOder($delivery_date,$user_id,$customer_id){
        try{
            $sql = "INSERT INTO `order`(`order_delivery_date`, `user_id`, `customer_id`) VALUES (:delivery_date, :user_id, :customer_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':delivery_date',$delivery_date);
            $stmt->bindValue(':user_id',$user_id);
            $stmt->bindValue(':customer_id',$customer_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getLastOrderNumber(){
        try{
            $sql = "SELECT * FROM `order` ORDER BY `order_number` DESC LIMIT 1;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;

        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    

    
    public function getCustomerIdByEmail($email){
        try{
            $sql = "SELECT `customer_id` FROM `customer` WHERE cust_email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email',$email);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function inserOrderDetail($product_id, $quantity,$price_sold,$order_number){
        try{
            $sql = "INSERT INTO `order_details`(`product_id`, `quantity`, `price_sold`, `order_number`) VALUES (:product_id, :quantity, :price_sold, :order_number)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_id',$product_id);
            $stmt->bindValue(':quantity',$quantity);
            $stmt->bindValue(':price_sold',$price_sold);
            $stmt->bindValue(':order_number',$order_number);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getProductPriceByProductId($product_id){
        try{
            $sql = "SELECT `price` FROM `product` WHERE $product_id = :product_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':product_id',$product_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
        
}
?>