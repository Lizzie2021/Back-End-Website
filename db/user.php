<?php

    class User{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }

        public function insertUser($firstname,$lastname,$user_role,$username,$password,){
            try {
                $result = $this->getUserbyUsername($username);
                if($result['num']>0){
                    return false;
                }else {
                    $hashed_password = password_hash($password,PASSWORD_DEFAULT);

                    $sql = "INSERT  INTO user (firstname,lastname,user_role,username,user_password) VALUES(:firstname,:lastname,:user_role,:username,:user_password)";

                    $stmt = $this->db->prepare($sql);

                    $stmt->bindValue(':firstname',$firstname);
                    $stmt->bindValue(':lastname',$lastname);
                    $stmt->bindValue(':username',$username);
                    $stmt->bindValue(':user_role',$user_role);
                    $stmt->bindValue(':user_password',$hashed_password);

                    $stmt->execute();
                    return true;

                }
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserbyUsername($username){
            try {
                $sql = "select count(*) as num from user where username = :username";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':username', $username);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch (PDOException $e)
            {
                echo $e->getMessage();
                return false;
            }
        }

        public function getUser($username,$password){
            try {
                $sql = "select * from user where username = :username ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':username',$username);
                $stmt->execute();
                $result = $stmt->fetch();
                
                if(password_verify($password,$result['user_password'])){
                    return $result;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getUsers(){
            try{
                $sql = "SELECT * FROM user";
                $result = $this->db->query($sql);
                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserDetails($id){
            try{
                $sql = "SELECT * FROM user WHERE user_id = :id ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function editUser($id,$fname,$lname,$user_role,$username,$password){
            $hashed_password = password_hash($password,PASSWORD_DEFAULT);

            try{
               $sql = "UPDATE `user` SET `firstname`=:fname,
               `lastname`=:lname,`user_role`=:user_role,`username`=:username,`user_password`=:password WHERE user_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->bindValue(':fname',$fname);
            $stmt->bindValue(':lname',$lname);
            $stmt->bindValue(':user_role',$user_role);
            $stmt->bindValue(':username',$username);
            $stmt->bindValue(':password',$hashed_password);
            
            $stmt->execute();
            return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function deleteUser($id){
            try{
                $sql = "DELETE FROM `user` WHERE user_id=:id";

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id',$id);
                $stmt->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

    }

?>