<?php
require('connection.php');
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
   $username=stripslashes($_REQUEST['username']);
   $username=mysqli_real_escape_string($conn,$username);
   $password=stripslashes($_REQUEST['password']);
   $password=mysqli_real_escape_string($conn,$password);
   $sql="SELECT * FROM users  WHERE username='$username' and password='$password'
   and role='0'";
   $sql1="SELECT * FROM users  WHERE username='$username' and password='$password'
   and role='1'";
   $sql2="SELECT * FROM users  WHERE username='$username' and password='$password'
   and role='2'";
   $res=mysqli_query($conn,$sql) or die(mysql_error());
   $res1=mysqli_query($conn,$sql1) or die(mysql_error());
   $res2=mysqli_query($conn,$sql2) or die(mysql_error());
   $row=mysqli_num_rows($res);
   $row1=mysqli_num_rows($res1);
   $row2=mysqli_num_rows($res2);
   if($row==1){
      $_SESSION['login']=$username;
      $_SESSION['pass']=$password;
      header("location:./admin/admin.php");
   }
   else if($row1==1){
      $_SESSION['login']=$username;
      $_SESSION['pass']=$password;
      header("location:./étudiant/etudiant.php");
   }
   else if ($row2==1){
      $_SESSION['login']=$username;
      $_SESSION['pass']=$password;
      header("location:./enseignant/enseignant.php");
   }
   else{
      header("location:../index-mdp.html");
      echo"";
   }
}
?>