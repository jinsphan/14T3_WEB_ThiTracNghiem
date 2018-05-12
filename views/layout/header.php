<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="softdevelopinc">
    <meta name="author" content="softdevelopinc@gmail.com">

    <!-- Le styles -->
    <link href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo RootREL; ?>media/bootstrap/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo RootREL; ?>media/css/main.css" rel="stylesheet">
    <script src="<?php echo RootREL; ?>media/libs/js/jquery.min.js"></script>
    <script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap.min.js"></script>
</head>
<body role="document" cz-shortcut-listen="true">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Management students system</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo html_helper::url('/'); ?>">Home</a></li>
            <li><a href="<?php echo html_helper::url(array('ctl'=>'about')); ?>">About</a></li>
            <li><a href="<?php echo html_helper::url(array('ctl'=>'students')); ?>">Management students</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container theme-showcase" role="main">
