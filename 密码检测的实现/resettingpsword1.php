<?php
session_start();
if(!$_SESSION['name']){
  echo"<script>alert('请先登录！');self.location='login.html';;</script>";
}
else{
echo $_SESSION['name'];
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
        <title>Login and Registration Form with HTML5 and CSS3</title>
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
                    <a href=login.html>
                        <strong>Back to login</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>云上传服务 </h1>
				<nav class="codrops-demos">
					<span>Click <strong>"back to login"</strong> to login </span>
				</nav>
            </header>
            <section>
                <div id="container_demo" >

                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form id="loginForm" action="resettingpsword.php" method="post" autocomplete="on" onsubmit="return onsubmit1()">
                                <h1>resetting Your Password</h1>
                                    <p>
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>

                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
								<p >
									<style type="text/css">
										input.correct{border:1px solid green;}
										input.error{border:1pxsolid red;}
										tips{float:left;margin:2px 0 0 20px;}
										#tips span{float:left;width:50px;height:20px;color:#fff;overflow:hidden;background:#ccc;margin-right:2px;line-height:20px;text-align:center;}
										#tips.s1 .active{background:#f30;}
										#tips.s2 .active{background:#fc0;}
										#tips.s3.active{background:#cc0;}
										#tips.s4 .active{background:#090;}
									</style>
									<script type="text/javascript">
										window.onload = function() {
											var oTips = document.getElementById("tips");
											var oInput = document.getElementById("passwordsignup");
											var aSpan = oTips.getElementsByTagName("span");
											var aStr = ["弱", "中", "强", "非常好"];
											var i = 0;

											oInput.onkeyup = oInput.onfocus = oInput.onblur = function() {
											var index = checkStrong(this.value);
											this.className = index ? "correct": "error";
											oTips.className = "s" + index;
											for (i = 0; i < aSpan.length; i++) aSpan[i].className = aSpan[i].innerHTML = "";
												index && (aSpan[index - 1].className = "active", aSpan[index - 1].innerHTML = aStr[index - 1])
											}
										};
								/** 强度规则
								------------------------------------------------------- +
								1) 任何少于6个字符的组合，弱；任何字符数的同类字符组合，弱；
								2) 任何字符数的两类字符组合，中；
								3) 12位字符数以下的三类或四类字符组合，强；
								4) 12位字符数以上的三类或四类字符组合，非常好。
								+ ------------------------------------------------------- +
								**/
								//检测密码强度
									function checkStrong(sValue) {
										var modes = 0;
											if (sValue.length < 6) return modes;
											if (/\d/.test(sValue)) modes++; //数字
											if (/[a-z]/.test(sValue)) modes++; //小写
											if (/[A-Z]/.test(sValue)) modes++; //大写?
											if (/\W/.test(sValue)) modes++; //特殊字符
											switch (modes) {
												case 1:
													return 1;
													break;
												case 2:
													return 2;
												case 3:
												case 4:
													return sValue.length < 12 ? 3 : 4
													break;
											}
									}
							</script>
									<div id="tips">
										<span></span>
										<span></span>
										<span></span>
										<span></span>
									</div>
								</p>

                                <p class="signin button">
									<input id="submit"  type="submit" name="submit" value="Sign up"/>
								</p>
								<p>
								<script>

    								var loginForm = document.getElementById('loginForm');
    								var submit = document.getElementById('submit');
									var password1 = loginForm.passwordsignup.value;
									var password2 = loginForm.passwordsignup_confirm.value;
									function onsubmit1() {
										if(submit.onclick1())
											{
												return true;
											}
										else{
										loginForm.passwordsignup.focus();
											return false;
											}
										}
    								submit.onclick1 = function(){
        							var password1 = loginForm.passwordsignup.value;
									var password2 = loginForm.passwordsignup_confirm.value;
        							//这里判断了用户名的输入不能为空，且长度为6-16位
								if(checkStrong(password1)<2){
								alert('禁止弱口令');
								}
								else{
        							if(password1 && (typeof(password1)!='undefined') && (password1!=0) && (password1.length>=6) && (password1.length<=16)){
           							//验证通过，提交表单数据
									if(password1!=password2){
									alert('请检查密码两次填写是否正确');
									loginForm.passwordsignup.focus();
									return false;
									}else{
									return true;
									}
        							}else{
            						alert('请检查密码是否为空或者密码长度是否在6-16位之间');

									loginForm.passwordsignup.focus(); //输入焦点 到密码框。
									return false; //返回一个 失败
        								}

    								}
								}

								</script>
								</p>
                                <p class="change_link">
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>

                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
<?php
if($_GET['action'] == "logout"){
  unset($_SESSION['name']);
  echo"<script>alert('注销登录成功！');self.location='login.html';</script>";
} ?>
