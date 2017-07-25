<?php
if(!isset($_POST['submit'])){
      echo"<script>alert('非法访问！');self.location='login.html';</script>";
  }//判断是否有submit操作
  $exist=0;
  $name=$_POST['usernamesignup'];
  $email=$_POST['emailsignup'];
  //$name="login";
  //$email="logi@qq.com";
  //$password="login";
  $password=$_POST['passwordsignup'];
  $pwd_again=$_POST['passwordsignup_confirm'];
  if(!$password==$pwd_again){
     echo"<script>alert('密码不一致');self.location='login.html';</script>";
  }
  else{
  include('connect.php');//链接数据库
  $sql="SELECT `UserName`, `PassWord`, `E-mail` FROM `user` WHERE `UserName`='$name'or `E-mail`='$email'";
  $result = mysqli_query($conn, $sql);
  $num=mysqli_num_rows($result);
  echo "$num<br/>";
  if($num){
    $exist=1;
     echo"<script>alert('用户名或邮箱已存在');self.location='login.html';</script>";
  }
  else{
    //$algo=sha256;
    $salt=$name;
    $iterations=1000;
    echo "$salt<br/>";
    $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
    echo "$hash<br/>";
    $sql = "INSERT INTO `user`(`UserName`, `PassWord`, `E-mail`, `Type`) VALUES ('$name','$hash','$email','0')";
    mysqli_query($conn, $sql);
    echo"<script>alert('注册成功！');self.location='login.html';</script>";
  }
  mysql_close($conn);//关闭数据库
}

?>
