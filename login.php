<?php
include './showErrors.php';
session_start();

if (isset($_SESSION["is_login"])) {
    if ($_SESSION["is_login"] == true) {
        header("Location: profile.php");
        exit();
    }
}  
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SL Elections</title>
        <link type="text/css" rel="stylesheet" href="login.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500;600&family=Ranchers&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="images/logo.png"/>
    </head>
    <body>
        <div class="box-outer">
              <div class="box-body-inner">
                  <div class="head-1">
                  <h1 class="login-head">Get Signed In </h1>
                  </div>
                  <div class="inner">
                  <div class="image-div"></div>
                  <form id="login" class="data-input-form" method="post"  action="doLogin.php">
                  <br/>
                  <br/>
                        <br/>
                        <br/>
                        <input type="password"  class="user-input-field" placeholder="Please Enter Your Password"   name="pswd" id="pswd"  autocomplete="off" onmouseover="usernameLoginClick();" onmouseout="usernameChangeLoginClick();"required /> <!-- password is checked as the username for entering input-->
                        <br/>
                        <button type="submit" class="submit-button">Sign In</button>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <a href="register.php" class="anchorTag">Don't Have An Account? Sign Up</a>
                    </form>
                  </div>
            </div>
        </div>
        <script  type="text/javascript" src="login.js"></script>
    </body>
</html>

