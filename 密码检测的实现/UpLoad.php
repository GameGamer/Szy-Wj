<?php
if(!isset($_POST['submit'])){
      echo"<script>alert('非法访问！');self.location='Main.php';</script>";
  }//判断是否有submit操作
  //$exist=0;
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
  $sql="SELECT `UserName`, `E-mail` FROM `user` WHERE `UserName`='$name'or `E-mail`='$email'";
  $result = mysqli_query($conn, $sql);
  $num=mysqli_num_rows($result);
  if($num){
    //$exist=1;
    echo"<script>alert('用户名或邮箱已存在');self.location='login.html';</script>";
  }
  else{
    //$algo=sha256;
    $salt_name=$name;
    $iterations=1000;
    $hash_name = hash_pbkdf2("sha256", $password, $salt_name, $iterations, 20);
    $salt_email=$email;
    $hash_email=hash_pbkdf2("sha256", $password, $salt_email, $iterations, 20);
    $sql = "INSERT INTO `user`(`UserName`, `PassWordByUser`, `E-mail`,`PasswordByEmail`,`Type`) VALUES ('$name','$hash_name','$email','$hash_email','0')";
    mysqli_query($conn, $sql);
    echo"<script>alert('注册成功！');self.location='login.html';</script>";
  }
  mysql_close($conn);//关闭数据库
}

?>
