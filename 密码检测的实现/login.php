<?php
if(!isset($_POST['submit'])){
    exit("错误执行");
  }//判断是否有submit操作
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
    echo "successful<br/>";
    $exist=1;
    echo "$exist<br/>";
  }
  else{
    //$algo=sha256;
    echo "failed";
  }
  mysql_close($conn);//关闭数据库

?>
