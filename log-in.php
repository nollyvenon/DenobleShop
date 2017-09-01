<?php
require_once("includes/initialize_admin.php");
if ($session_admin->is_logged_in()) {
    redirect_to("dashboard");
}

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $username = strip_tags(trim($_POST['identity']));
    $password = strip_tags(trim($_POST['password']));
    
    // Check database to see if username/password exist.
    $found_user = $admin_object->authenticate($username, $password);
    print_r( $found_user);
    if($found_user) {
        if($admin_object->admin_is_active($username)) {
            $found_user = $found_user[0];
            $session_admin->login($found_user);
            redirect_to("dashboard");
        } else {
            $message_error = "Your profile has certain issues, please contact support.";
        }
    } else {
        // username/password combo was not found in the database
        $message_error = "Username and password combination do not match.";
    }
} else { // Form has not been submitted.
    $username = "";
    $password = "";
}

if(isset($_GET['logout'])) {
    $logout_code = $_GET['logout'];
    switch ($logout_code) {
        case 1:
            $message_success = "You have logged out";
            break;
        case 2:
            $message_success = "You have been auto-logged out due to inactivity";
            break;
    }
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <script type="text/javascript">if (parent.frames.length !== 0) {
        top.location = '<?php echo SITE_URL;?>/pos';
    }</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS;?>/images/icon.png"/>
    <link href="<?php echo SITE_ASSETS;?>/styles/theme.css" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS;?>/styles/helpers/login.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery-2.0.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_ASSETS;?>/js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login-page">
    <noscript>
        <div class="global-site-notice noscript">
            <div class="notice-inner">
                <p>
                    <strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                    your browser to utilize the functionality of this website.
                </p>
            </div>
        </div>
    </noscript>
    <div class="page-back">
        <div class="text-center">
            <img src="<?php echo SITE_URL;?>/uploads/logos/logo42.png" alt="ZentaBooks" style="margin-bottom:10px;" />        </div>

        <div id="login">
            <div class=" container">

                <div class="login-form-div">
                    <div class="login-content">
    <form method="post" action="">
<input type="hidden" name="token" value="874fea19e08e926a623b26dfcbef5684" />                                                                                                   
                        <div class="div-title col-sm-12">
                            <h3 class="text-primary">Please login to your account.</h3>
                        </div>
                        <?php if(isset($message_success)): ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $message_success; ?>
                    </div>
                    <?php endif ?>
                    <?php if(isset($message_error)): ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $message_error; ?>
                    </div>
                    <?php endif ?>
                        <div class="col-sm-12">
                            <div class="textbox-wrap form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" value="" required="required" class="form-control" name="identity"
                                    placeholder="Username"/>
                                </div>
                            </div>
                            <div class="textbox-wrap form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" value="" required="required" class="form-control " name="password"
                                    placeholder="Password"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-action col-sm-12">
                            <div class="checkbox pull-left">
                                <div class="custom-checkbox">
                                    <input type="checkbox" name="remember" value="1"  id="remember" />
                                </div>
                                <span class="checkbox-text pull-left"><label for="remember">Remember me</label></span>
                            </div>
                           <!-- <button name="submit" type="submit" class="btn btn-success pull-right">Login &nbsp; <i class="fa fa-sign-in"></i></button>-->
                            <input type="submit" name="submit" class="btn btn-success pull-right" value="Login ">
                        </div>
                        </form>                        <div class="clearfix"></div>
                    </div>
                    <div class="login-form-links link2">
                        <h4 class="text-danger">Forgot your password?</h4>
                        <span>Don't worry!</span>
                        <a href="#forgot_password" class="text-danger forgot_password_link">click here</a>
                        <span>to reset</span>
                    </div>
                                    </div>
            </div>
        </div>

        <div id="forgot_password" style="display: none;">
            <div class=" container">
                <div class="login-form-div">
                    <div class="login-content">
                                                <div class="div-title col-sm-12">
                            <h3 class="text-primary">Forgot Password</h3>
                        </div>
                        <form action="<?php echo SITE_URL;?>/auth/forgot_password" class="login" data-toggle="validator" method="post" accept-charset="utf-8">
                                                                                               <input type="hidden" name="token" value="874fea19e08e926a623b26dfcbef5684" />
                        <div class="col-sm-12">
                            <p>
                                Please type email address to get reset instructions                            </p>
                            <div class="textbox-wrap form-group">
                                <div class="input-group">
                                    <span class="input-group-addon "><i class="fa fa-envelope"></i></span>
                                    <input type="email" name="forgot_email" class="form-control "
                                    placeholder="Email Address" required="required"/>
                                </div>
                            </div>
                            <div class="form-action">
                                <a class="btn btn-success pull-left login_link" href="#login">
                                    <i class="fa fa-chevron-left"></i> Back                                </a>
                                <button type="submit" class="btn btn-primary pull-right">
                                    Submit &nbsp;&nbsp; <i class="fa fa-envelope"></i>
                                </button>
                            </div>
                        </div>
                        </form>                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
            </div>

    <script src="<?php echo SITE_ASSETS;?>/js/jquery.js"></script>
    <script src="<?php echo SITE_ASSETS;?>/js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_ASSETS;?>/js/jquery.cookie.js"></script>
    <script src="<?php echo SITE_ASSETS;?>/js/login.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            localStorage.clear();
            var hash = window.location.hash;
            if (hash && hash != '') {
                $("#login").hide();
                $(hash).show();
            }
        });
    </script>
</body>
</html>
