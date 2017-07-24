<?php
//if(!isset($_POST['submit'])){
    //exit("错误执行");
  //}//判断是否有submit操作
  $exist=0;
  $name=$_POST['usernamesignup'];
  $email=$_POST['emailsignup'];
  //$name="login";
  //$email="logi@qq.com";
  //$password="login";
  $password=$_POST['passwordsignup'];
  $pwd_again=$_POST['passwordsignup_confirm'];
  if(!$password==$pwd_again){
     echo"<script>alert('密码不一致');history.go(-1);</script>";
  }
  else{
  include('connect.php');//链接数据库
  $sql="SELECT `UserName`, `PassWord`, `E-mail` FROM `user` WHERE `UserName`='$name'or `E-mail`='$email'";
  $result = mysqli_query($conn, $sql);
  $num=mysqli_num_rows($result);
  echo "$num<br/>";
  if($num){
    $exist=1;
     echo"<script>alert('用户名或邮箱已存在');history.go(-1);</script>";
  }
  else{
    //$algo=sha256;
    $salt=$name;
    $iterations=1000;
    echo "$salt<br/>";
    $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
    echo "$hash<br/>";
    $sql = "INSERT INTO `user`(`UserName`, `PassWord`, `E-mail`) VALUES ('$name','$hash','$email')";
    mysqli_query($conn, $sql);
  }
  mysql_close($conn);//关闭数据库
}

?>
