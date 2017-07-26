<?php
/*
if(!isset($_POST['submit'])){
    exit("错误执行");
  }//判断是否有submit操作
  */
  $exist=0;
  $name=$_POST['username'];
  //$name="login";
  $email=$_POST['username'];
  //$name="login";
  //$email="login@qq.com";
  //$password="login2";
  $password=$_POST['password'];
  include('connect.php');//链接数据库
  $salt=$name;
  $iterations=1000;
  echo "$salt<br/>";
  $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
  echo "$hash<br/>";
  $sql="SELECT `UserName`, `PassWord`, `E-mail` FROM `user` WHERE (`UserName`='$name'or `E-mail`='$email') and `PassWord`='$hash'";
  $result = mysqli_query($conn, $sql);
  $num=mysqli_num_rows($result);
  echo "$num<br/>";
  if($num){
    $exist=1;
    echo"<script>alert('登录成功！');history.go(-1);</script>";
  }
  else{
    //$algo=sha256;
    echo"<script>alert('用户名或密码错误！');history.go(-1);</script>";
  }
  mysql_close($conn);//关闭数据库

?>
