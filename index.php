<?php 
session_start();
require_once 'db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <style type="text/css">
            * {
                box-sizing: border-box;
            }

            *:focus {
                outline: none;
            }
            body {
                font-family: Arial;
                background-color: #F0F4C3 ;
                padding: 50px;
            }
            .login {
                margin: 2% auto;
                width: 550px;
            }
            .login-screen {
                background-color: #FFF;
                padding: 20px;
                border-radius: 5px;

            }

            .powerd_by{
                position: relative;
                text-align: right;
                bottom: -15px;
                right: -15px;
                font-size: small;
                color: red;
            }

            .app-title {
                text-align: center;
                color: #777;
            }

            .login-form {
                text-align: center;
            }
            .control-group {
                margin-bottom: 10px;
            }

            input {
                text-align: center;
                background-color: #ECF0F1;
                border: 2px solid transparent;
                border-radius: 3px;
                font-size: 16px;
                font-weight: 200;
                padding: 10px 0;
                width: 250px;
                transition: border .5s;
            }

            input:focus {
                border: 2px solid #3498DB;
                box-shadow: none;
            }

            .btn {
                border: 2px solid transparent;
                background: #03a9f4;
                color: #ffffff;
                font-size: 16px;
                line-height: 25px;
                padding: 10px 0;
                text-decoration: none;
                text-shadow: none;
                border-radius: 3px;
                box-shadow: none;
                transition: 0.25s;
                display: block;
                width: 250px;
                margin: 0 auto;
            }

            .btn:hover {
                background-color: #01579b;
            }

            .login-link {
                font-size: 12px;
                color: #444;
                display: block;
                margin-top: 12px;
            }

            .main_logo_div{
                position: relative;
                top: 102px;
                width: 130px;
                height: 115px;
               

            }

            .footer_div{
                position: fixed;
                width: 100%;
                height: 27%;
                margin: 0;
                bottom: 0px;
                left: 0px;
                background-color:#039be5;
                z-index: -1;

            }

        </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<script language="javascript" language="javascript" src="js/reset_form.js"></script>
<script language="javascript">
function login_validation(){
	with(document.login_form){
		valid=true;
                //alert((uname.value+'-'+pwd.value)
		if(uname.value == "" && pwd.value == ""){
			valid=false;
                        //alert("ggggg");
			alert("Enter Username and Password");
			uname.focus();
		}else if(uname.value == ""){
			valid=false;
			alert("Enter Username");
			uname.focus();
		}else if(pwd.value == ""){
			valid=false;
			alert("Enter Password");
			pwd.focus();
		}     //  else if(uname.value == "admin" && pwd.value == "123"){
//                    window.location.href ='admin_index.php';
            
            //    }
		//return valid;

	}
}
</script>
</head>
<body>
        <form action="login.php" method="post" name="login_form" id="login_form" onsubmit=" return login_validation();">
            <div class="login">
                <div class="main_logo_div">
                    <img src="images/logo_transparent.png" width="130px" height="111px"/>

                </div>
                <div class="login-screen">
                    <div class="app-title">
                        <h1>Login</h1>
                    </div>

                    <div class="login-form">

                        <div class="control-group">
                            <input type="text" class="login-field" value="" placeholder="username" name="uname" autocomplete="off" id="uname">
							
                            <label class="login-field-icon fui-user" for="login-name"></label>
                        </div>

                        <div class="control-group">
                            <input type="password" class="login-field"  placeholder="password" name="pwd" autocomplete="off" id="pwd">
                            <label class="login-field-icon fui-lock" for="login-pass"></label>
                        </div>

                        <input name="login" type="submit" class="btn btn-primary btn-large btn-block" id="login" value="Login">
                        <!--<a class="login-link" href="#">forgot your password ?</a>-->
                    </div>
                    <div class="powerd_by">
                        <a style="color:blue; text-decoration: none;" href="">Created by W.G.M.Rashmi</a>
                    </div>
                </div>

            </div>
            <div class="footer_div">

            </div>
      
      <?php if(isset($_SESSION['log_error_mes'])){?><img src="images/warning.png" width="48" height="48" /> <?php echo $_SESSION['log_error_mes'];}?>
            </form>
     
</body>
</html>
<?php unset($_SESSION['log_error_mes']);?>