<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/login.css" rel="stylesheet">

<div class="login-container">
    <div class="container">
        <div class="login-content box-shadow">
            <div class="title-login">
                <h3>TẠO BÀI THI</h3>
            </div>

            <br>

            <div class="login-form-container">
                <form action="/quiz/create" method="POST" >
                    <div class="form-group">
                        <label for="name">Tên bài thi:</label>
                        <input type="text" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea class="form-control description" id="description" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="typemon">Thuộc môn:</label>
                        <select class="form-control" id="typemon">
                            <option>Môn...</option>
                            <option>Toán</option>
                            <option>Lí </option>
                            <option>Hóa</option>
                            <option>Anh văn</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="maxtime">Thời gian:</label>
                                <input type="number" class="form-control" id="maxtime">
                            </div>
                            <div class="col-md-6">
                                <label for="maxscore">Tổng điểm:</label>
                                <input type="number" class="form-control" id="maxscore">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="filequestion">Tải bộ câu hỏi:</label>
                        <input type="file" class="form-control" id="filequestion">
                    </div>

                    <div class="checkbox">
                        <label><input type="radio" name="type"> Private</label>
                        <label><input type="radio" name="type"> Public</label>
                    </div>
                   
                    <div class="submit-container">
                        <button type="submit" class="btn-submit bg-main">Tạo</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>