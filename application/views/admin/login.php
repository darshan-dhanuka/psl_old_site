<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PSL Admin Login | </title>

    <!-- Bootstrap -->
    <link href="<?php echo ADMIN_CSS_PATH;?>/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo ADMIN_CSS_PATH;?>/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo ADMIN_CSS_PATH;?>/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="post">
              <h1>Admin Login</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                <div><?php echo $error;?></div>
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" value="Log in" class="btn btn-default submit">                
              </div>
              <div class="clearfix"></div>
              <div class="separator">                
                <div>
                  <h1><i class="fa fa-paw"></i> PSL!</h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
