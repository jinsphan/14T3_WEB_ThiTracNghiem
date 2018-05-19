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
                <?php if (!isset($this->success)) { ?>
                <form action="/register" method="POST" >
                    <div class="form-group">
                        <label for="username">Tên đăng nhập: <span class="require-form">*</span></label>
                        <input type="username" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="fullname">Tên đầy đủ: <span class="require-form">*</span></label>
                        <input type="fullname" class="form-control" id="fullname" name="fullname" required>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Giới tính:</label>
                        </div>
                        <div class="col-sm-4">
                            <label class="radio-inline"><input type="radio" name="sex" id="sex" value="Nam" checked="checked">Nam<label>
                        </div>
                        <div class="col-sm-4">
                        <label class="radio-inline"><input type="radio" name="sex" id="sex" value="Nữ">Nữ</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Ngày sinh: <span class="require-form">*</span></label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Mật khẩu: <span class="require-form">*</span></label>
                        <input type="password" class="form-control" id="pwd" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="repwd">Nhập lại mật khẩu: <span class="require-form">*</span></label>
                        <input type="password" class="form-control" id="repwd" name="repassword" required>
                    </div>

                    
                    <div class="form-group">
                        <?php 
                            if(isset($this->error))
                                echo "<span class='text-danger'>".$this->error."</span>";
                            if(isset($this->success))
                                echo "<span class='text-success'>".$this->success."</span>";
                        ?>    
                    </div>
                    <div class="submit-container">
                        <button type="submit" class="btn-submit bg-main">Đăng kí</button>
                        <br>
                        <br>
                        <span class="" href="">Nếu bạn là thành viên:  </span>
                        <a class="cl-main" href="/login">Đăng nhập</a>
                    </div>
                </form>
                <?php } else { ?>
                    <div class="text-center" id="countdown"></div>
                    <p class="text-center">Đăng kí thành công, vui lòng <a href="/login">đăng nhập</a> để tiếp tục (tự động chuyển hướng sang login sau 5s)</p>
                <?php } ?>
            </div>
            
            

        </div>
    </div>
</div>
<script src="/media/libs/js/timercountdown.js"></script>
<?php if (isset($this->success)) { ?>
<script>
    const countdown = $("#countdown").countdown360({
        radius: 60,
        strokeWidth: 16,
        seconds: 5,
        label: ['sec', 'secs'],
        fontColor: '#FFFFFF',
        autostart: false,
        clockwise: true,
        onComplete: () => {
            window.location.href = "<?= html_helper::url(["ctl" => "login"]); ?>";
        }
    });
    countdown.start();
</script>
<?php } ?>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>