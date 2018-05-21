<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PSCD Admin Template | Log in</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="softdevelopinc">
    <meta name="author" content="softdevelopinc@gmail.com">

    <link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/font-awesome.min.css">
  	<link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/AdminLTE.min.css">
  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><b>PSCD</b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post" action="<?php echo vendor_app_util::url(
		array('area'=>'admin', 
			  'ctl'=>'login',
			  'act'=>$this->action
	)); ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_submit">Sign In</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>

<script src="<?php echo RootREL; ?>media/js/jquery.min.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

