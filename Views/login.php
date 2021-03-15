<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Library</title>
	    <meta charset="utf-8">
	    <meta name="author" content="periyandavar">
	    <meta name="discription" content="library Mangement system">
	    <meta name="keywords" content="Library, LMS">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?php echo baseURL()?>/static/img/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?php echo baseurl();?>/static/css/userlogin.css">
    </head>
    <body> 
        <section class="card">
            <h1>User Login</h1>
            <hr>
            <form action="#" method="POST">                                     
                <div class="form-input-div">
                    <label>Enter Email</label>
                    <input class="form-control" type="email" name="email" id="emailid" placeholder="Email..." autocomplete="off" required="">  <!--onblur="checkAvailability()"-->
                    <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>                    
                <div class="form-input-div">
                    <label>Enter Password</label>
                    <input class="form-control" name="password" type="password" placeholder="********" autocomplete="off" required="">
                    <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none" value="0"></meter>
                    <span id="pass1msg" style="display:none"></span>
                </div>   
                <div class="form-input-div">
                        <label>Verification code : </label>
                        <input type="text" name="verfcode" maxlength="5" autocomplete="off" placeholder="Verification Code..." required="" style="width: 150px; height: 25px;">&nbsp;<img id="logImg" src="<?php echo baseurl() . "/home/captcha"; ?>">
                </div>                                  
                <div class="form-buttons">
                    <button type="submit" name="login" class="button-control positive">Login</button>
                    <!-- <a href="registration" class="button-control negative">Register</a> -->
                </div>
                <div class="msg">
                    <?php if(isset($msg)) echo $msg ?>
                </div>
                <br><span> Don't have an account..? <a class="link" href="registration"> Register here </a></span>

            </form>
        </section>
    </body>
</html>
  