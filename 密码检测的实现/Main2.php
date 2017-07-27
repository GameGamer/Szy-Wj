<?php
session_start();
if(!$_SESSION['name']){
  echo"<script>alert('请先登录！');self.location='login.html';;</script>";
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style3.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">

                <span class="right">
                    <a href="Main.php?action=logout">
                        <strong>Log Out</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>云上传服务 </h1>
				<nav class="codrops-demos">
					<span>Hi <strong><?php echo $_SESSION['name'];?></strong> WelCome </span>
				</nav>
            </header>
            <section>
                <div id="container_demo" >

                    <div id="wrapper">
                        <div id="login" class="animate form">
						<form  action="DownFile.php" method="post" autocomplete="on">
              <?php
              include('connect.php');
              $name=$_SESSION['name'];
              $sql="SELECT `Title`,`Random` FROM `Documents` WHERE `UserName`='$name'";
              $result = mysqli_query($conn, $sql);
                echo "文件名--------------------随机码<br/>";
              while($row=mysqli_fetch_array($result)){
                echo $row['Title']."--------------------".$row['Random'];
              }
              ?>

               <p>

                   <input id="identifycode" name="identifycode" required="required" type="identifycode" placeholder="输入四位随机码"/>
               </p>
               <p class="login button">
                   <input id="submit" type="submit" name="submit" value="下载文件" />
             </p>

						</form>

                        </div>

                    </div>
                </div>
				<script>
  var isIE = /msie/i.test(navigator.userAgent) && !window.opera;
   function filefujianChange(target) {
       var fileSize = 0;
       if (isIE && !target.files) {
         var filePath = target.value;
         var fileSystem = new ActiveXObject("Scripting.FileSystemObject");
         var file = fileSystem.GetFile (filePath);
         fileSize = file.Size;
       } else {
        fileSize = target.files[0].size;
        }
        var size = fileSize / 1024;
        if(size>10000){
         alert("附件不能大于10M");
         target.value="";
         return
        }
        var name=target.value;
        var fileName = name.substring(name.lastIndexOf(".")+1).toLowerCase();
        if(fileName !="jpg" && fileName !="jpeg" && fileName !="pdf" && fileName !="png" && fileName !="dwg" && fileName !="gif" && fileName !="xls" && fileName !="xlsx" &&fileName !="docx" &&fileName !="doc"&& fileName !="txt" ){
          alert("请选择图片格式文件上传(jpg,png,gif,dwg,pdf,gif等)或者office文档格式（doc,docx,txt,excl等）！");
            target.value="";
            return
        }
      }
	 </script>
            </section>
        </div>
    </body>
</html>

<?php
if($_GET['action'] == "logout"){
  unset($_SESSION['name']);
  echo"<script>alert('注销登录成功！');self.location='login.html';</script>";
} ?>
