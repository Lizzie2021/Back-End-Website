<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $host = '127.0.0.1';
    $db = 'mobile_hour';
    $user = 'manager';
    $password = '3ddHrwJ]5nj5Lad8';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOException $e){
        throw new PDOException($e->getMessage());
        
    }

    require_once "crud.php";
    require_once "user.php";
    $user = new User($pdo);
    $crud = new Crud($pdo);
    
    $user->insertUser("Lizzie","Li","manager","manager","3ddHrwJ]5nj5Lad8");


?>