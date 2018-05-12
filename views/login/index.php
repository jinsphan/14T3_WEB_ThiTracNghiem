<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/login.css" rel="stylesheet">

<div class="login-container">
    <div class="container">
        <div class="login-content box-shadow">
            <div class="title-login">
                <h3>ĐĂNG NHẬP</h3>
            </div>

            <br>

            <div class="login-form-container">
                <form action="/login" method="POST" >
                    <div class="form-group">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox"> Tự động đăng nhập lần sau</label>
                    </div>
                    <div class="submit-container">
                        <button type="submit" class="btn-submit bg-main">Đăng nhập</button>
                        <br>
                        <br>
                        <a class="cl-main" href="#">Quên mật khẩu </a> |
                        <a class="cl-main" href="/register">Đăng kí tài khoản mới</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>