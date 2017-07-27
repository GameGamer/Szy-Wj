<?php
session_start();
if(!$_SESSION['name']){
  echo"<script>alert('请先登录！');self.location='login.html';;</script>";
}
else{
echo $_SESSION['name']."<br />";
}
$username=$_SESSION['name'];
include('connect.php');
$input_file  = $_FILES["file"]["tmp_name"];
include('encode.php');
$key=$enc_key;
function randomkeys($length)
{
  $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ'; //字符池
    for($i=0;$i<$length;$i++)
    {
      $key .= $pattern{mt_rand(0,61)}; //生成php随机数
    }
  return $key;
}
//echo "$ciphertext<br/>";

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& (($_FILES["file"]["size"]/1024/1024) < 10))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024/1024) . " Mb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    $algo="sha256";
    $hash_file_name=hash_file ($algo,$_FILES["file"]["tmp_name"],FALSE);
    $sql="SELECT `HashFile`,`Username` FROM `Documents` WHERE `HashFile`='$hash_file_name'and `UserName`='$username'";
    $result = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if ($num)
      {
      echo $username.'_'.$hash_file_name. " already exists. ";
      }
    else
      {
          //$myfile = fopen($_FILES["file"]["name"], "w");
          $myfile = fopen("/var/www/html/rua/upload/".$username."_".$hash_file_name, "w") or die("Unable to open file!");
          $txt = $saved_ciphertext;
          fwrite($myfile, $txt);
          fclose($myfile);
          $random=randomkeys(4);
          $name=$_FILES["file"]["name"];
          $sql="INSERT INTO `Documents` (`UserName`, `Title`, `HashFile`, `UserKey`, `FileKey`, `Random`) VALUES ('$username','$name','$hash_file_name','0','$key','$random')";
          mysqli_query($conn,$sql);
          echo "Stored in: " . "upload/".$username.'_'. $hash_file_name;
          mysqli_close($conn);

      }
    }
  }
else
  {
  echo "Invalid file";
  }
  //move_uploaded_file($saved_ciphertext,"upload/".$username.'_'. $hash_file_name)
/*
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

*/
?>
