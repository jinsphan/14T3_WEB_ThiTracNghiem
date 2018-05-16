<!DOCTYPE html>
<html lang="en">

<?php include("views/layout/head.php"); ?>

<body role="document" cz-shortcut-listen="true">
<header>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="logo">
          <a href="/"><img src="/media/img/home/foo-logo.png" alt=""></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="login-regiser-btn">
          <div class="login-btn">
            <a href="/login">Đăng nhập</a>
          </div>
          <div class="register-btn">
            <a href="/register">Đăng kí</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row menu-container">
      <div class="col-md-8">
        <div class="menu-list">
          <ul>
            <li>
              <a href="javascript:void(0)">
                <i class="fas fa-book"></i> 
                Môn <i class="fas fa-sort-down"></i>
              </a>
              <ul class="menu-dropdown">
                <li><a href="">Toan</a></li>
                <li><a href="">Li</a></li>
                <li><a href="">Hoa</a></li>
                <li><a href="">Anh van</a></li>
                <li><a href="">Mtp</a></li>
              </ul>
            </li>

            <li>
              <a href="/quiz/create">
                <i class="fas fa-cloud-upload-alt"></i>
                Tạo bài thi
              </a>
            </li>

            <li>
              <a href="javascript:void(0)">
                <i class="fas fa-terminal"></i>
                <div class="input-nhap-ma-code" class="input-group">
                  <form action="">
                    <input type="text" class="form-control" placeholder="Nhập mã bài thi">
                  </form>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 text-right">
        <div class="search-container">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>