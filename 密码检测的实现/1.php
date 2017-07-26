<?php
require_once 'mysql.php';  
$name=$_POST['usernamesignup'];
$email=$_POST['emailsignup']
$password=$_POST['passwordsignup'];
$pwd_again=$_POST['passwordsignup_confirm'];
$code=$_POST['check'];
echo"123";
echo($_POST);
echo"123";
if($name==""|| $password=="")
{
    echo"用户名或者密码不能为空";
}
else
{
    if($password!=$pwd_again)
    {
        echo"两次输入的密码不一致,请重新输入！";
        echo"<a href='register.php'>重新输入</a>";

    }
    else if($code!=$_SESSION['check'])
    {
        echo"验证码错误！";
    }
    else
    {
        $sql="insert into user values('105','$name','$password')";
        $result=mysql_query($sql);
        if(!$result)
        {
            echo"注册不成功！";
            echo"<a href='register.php'>返回</a>";
        }
        else
        {
            echo"注册成功!";
        }
    }
}
?>
