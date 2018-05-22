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
          <?php if (!isset($_SESSION["loginUser"]["username"])) { ?>
            <div class="btns login-btn">
              <a href="/login">Đăng nhập</a>
            </div>
            <div class="btns register-btn">
              <a href="/register">Đăng kí</a>
            </div>
          <?php } else { ?>
            <!-- <span>Xin chao admin!</span> -->
            <!-- <button class="btn bg-main"><a href="/user/logout">Log out</a></button> -->
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Xin chao <?= $_SESSION["loginUser"]["fullname"] ?>!
              <span class="caret"></span></button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="/quiz/management/page=1">Quản lí bài thi</a></li>
                <li><a href="/quiz/history">Lịch sử thi</a></li>
                <li><a href="/account/logout">Đăng xuất</a></li>
              </ul>
            </div>
          <?php } ?>
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
                <?php foreach($_SESSION["subjects"] as $key => $subject){ ?>
                  <li><a href="/subject/show/subject-id=<?= $subject["subject_id"] ?>"><?= $subject["subject_name"] ?></a></li>
                <?php } ?>
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
                  <form id="form_quiz_code" method="POST">
                    <input type="text" class="form-control" placeholder="Nhập mã bài thi">
                  </form>
                  <script>
                    $("#form_quiz_code").on("submit", e => {
                      e.preventDefault();
                      const quiz_code = $("#form_quiz_code input").val();
                      window.location.href = `/quiz/confirm/quiz_code=${quiz_code}`;
                    })
                  </script>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 text-right">
        <div class="search-container">
          <div id="form_search_quizs" class="input-group">
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
<script src="/media/js/search.js"></script>