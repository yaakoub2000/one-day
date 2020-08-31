<?php
    try{
        $connect = new PDO("mysql:host=localhost;dbname=oneday", "root", "");
    }catch(PDOException $error) {
        echo  "connection faild !";
      }
?>