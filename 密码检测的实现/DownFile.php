<?php
session_start();
if(!isset($_POST['submit'])){
      echo"<script>alert('非法访问！');self.location='login.html';</script>";
  }

  $username=$_SESSION['name'];
  $random=$_POST['identifycode'];
  $password=$_SESSION['psw'];
  include('connect.php');
  include('edcrypt.php');

  $sql="SELECT `HashFile`,`Title`,`FileKey` FROM `Documents` WHERE `UserName`='$username' and `Random`='$random'";
  $result = mysqli_query($conn, $sql);
  $row=$result->fetch_object();
  $hash_file_name=$row->HashFile;
  $title=$row->Title;
  $key=$row->FileKey;

  $key=decrypt($key,$password);


  $file_path=realpath("/var/www/html/rua/upload/".$username."_".$hash_file_name); //文件名
  if(file_exists($file_path)){
    $fp = fopen($file_path,"r");
    $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
    //echo $str = str_replace("\r\n","<br />",$str);
  }
/*
  Header( "Content-type:  application/octet-stream ");
  Header( "Accept-Ranges:  bytes ");
  Header( "Accept-Length: " .filesize($file_path));
  header( "Content-Disposition:  attachment;  filename= {$ti}");
  echo file_get_contents($file_path);
*/
if(!$_SESSION['name']){
  Header( "Content-type:  application/octet-stream ");
  Header( "Accept-Ranges:  bytes ");
  Header( "Accept-Length: " .filesize($file_path));
  header( "Content-Disposition:  attachment;  filename= {$ti}");
  echo file_get_contents($file_path);

}
else
{
  include('encode.php');
  $saved_ciphertext=$str;


  // 解析密文结构，提取解密所需各个字段

  list($extracted_method, $extracted_enc_options, $extracted_iv, $extracted_ciphertext) = explode('$', $saved_ciphertext);

  $decryptedtext = openssl_decrypt($extracted_ciphertext, $extracted_method, $key, $enc_options, hex2bin($extracted_iv));
  $myfile = fopen("/var/www/".$title, "w") or die("Unable to open file!");
  $file_path=realpath("/var/www/".$title);
  $txt = $decryptedtext;
  fwrite($myfile, $txt);
  fclose($myfile);
  Header( "Content-type:  application/octet-stream ");
  Header( "Accept-Ranges:  bytes ");
  Header( "Accept-Length: " .filesize($file_path));
  header( "Content-Disposition:  attachment;  filename= {$title}");
  echo file_get_contents($file_path);
}
  //echo "$decryptedtext";
  //readfile($decryptedtext);

  //downfile();
?>
