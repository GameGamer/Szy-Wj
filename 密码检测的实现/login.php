<?php

if(!isset($_POST['submit'])){
    echo"<script>alert('非法访问！');self.location='login.html';</script>";
  }//判断是否有submit操作


  $exist=0;
  $name=$_POST['username'];
  //$name="login";
  $email=$_POST['username'];
  //$name="login";
  //$email="login@qq.com";
  //$password="login2";
  session_start();
  $password=$_POST['password'];
  include('connect.php');//链接数据库
  $salt=$name;
  $iterations=1000;
  $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
  $sql="SELECT `UserName`, `PassWord`, `E-mail` FROM `user` WHERE (`UserName`='$name'or `E-mail`='$email') and `PassWord`='$hash'";
  $result = mysqli_query($conn, $sql);
  $num=mysqli_num_rows($result);
  if($num){
    $exist=1;
    $_SESSION['name']=$name;
    echo"<script>alert('登录成功！');self.location='Main.php';</script>";
  }
  else{
    //$algo=sha256;
    echo"<script>alert('用户名或密码错误！');self.location='login.html';</script>";
  }
  mysql_close($conn);//关闭数据库

?>
