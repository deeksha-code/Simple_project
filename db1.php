<?php
 $conn=new mysqli("localhost","root","","",3307);

 if($conn->connect_error){
   die("mysql connection error . $conn->connect_error");
 }
 
 $conn->quey("CREATE DATABASE IF NOT EXISTS users_db");

 $conn->select_db("users_db");

 $conn->query("CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(30),email VARCHAR(30))");

?>