<?php
$servername="127.0.0.1";
$username="root";
$password="";
$data="poly";

//création de la connexion
$conn=new mysqli($servername,$username,$password,$data);

//test de connexion
if($conn->connect_error){

    die("Connection failed :".$conn->connect_error);
}
?>