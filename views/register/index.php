<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/login.css" rel="stylesheet">

<div class="login-container">
    <div class="container">
        <div class="login-content box-shadow">
            <div class="title-login">
                <h3>ĐĂNG KÍ TÀI KHOẢN</h3>
            </div>

            <br>

            <div class="login-form-container">
                <form action="/register" method="POST" >
                    <div class="form-group">
                        <label for="username">Tên đăng nhập: <span class="require-form">*</span></label>
                        <input type="username" class="form-control" id="username">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Mật khẩu: <span class="require-form">*</span></label>
                        <input type="password" class="form-control" id="pwd">
                    </div>

                    <div class="form-group">
                        <label for="repwd">Nhập lại mật khẩu: <span class="require-form">*</span></label>
                        <input type="password" class="form-control" id="repwd">
                    </div>

                    <div class="form-group">
                        <label for="fullname">Tên dầy đủ: <span class="require-form">*</span></label>
                        <input type="fullname" class="form-control" id="fullname">
                    </div>

                    <div class="submit-container">
                        <button type="submit" class="btn-submit bg-main">Đăng kí</button>
                        <br>
                        <br>
                        <span class="" href="">Nếu bạn là thành viên:  </span>
                        <a class="cl-main" href="/login">Đăng nhập</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>