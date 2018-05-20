<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/login.css" rel="stylesheet">
<link href="<?php echo RootREL; ?>media/css/quiz.css" rel="stylesheet">

<div class="login-container">
    <div class="container">
        <div class="create_quiz_container login-content box-shadow">
            <div class="title-login">
                <h3>TẠO BÀI THI</h3>
            </div>

            <br>

            <div class="quiz-create-form-container">
                <form id="form_add_quiz" action="/quiz/create" method="POST" >
                    <div class="form-group">
                        <label for="quiz_name">Tên bài thi:</label>
                        <input type="text" class="form-control" id="quiz_name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea class="form-control description" id="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="subject_id">Thuộc môn:</label>
                        <select class="form-control" id="subject_id" required>
                            <option value="1">Toán</option>
                            <option value="2">Lí </option>
                            <option value="3">Hóa</option>
                            <option value="4">Anh văn</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="max_time">Thời gian(min):</label>
                                <input type="number" class="form-control" id="max_time" required>
                            </div>
                            <div class="col-md-6">
                                <label for="max_score">Tổng điểm:</label>
                                <input type="number" class="form-control" id="max_score" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="filequestion">Tải bộ câu hỏi:</label>
                        <input type="file" class="form-control" id="filequestion" required>
                    </div>

                    <div class="checkbox" id="form_quiz_type">
                        <label><input checked="checked" key="1" type="radio" name="quiz_type_id"> Private</label>
                        <label><input key="2" type="radio" name="quiz_type_id"> Public</label>
                    </div>

                    <div class="form-group" id="form-start-end-time-quiz">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_time_quiz">Thời gian bắt đầu:</label>
                                <input type="datetime-local" class="form-control" id="start_time_quiz">
                            </div>
                            <div class="col-md-6">
                                <label for="end_time_quiz">Thời gian kết thúc:</label>
                                <input type="datetime-local" class="form-control" id="end_time_quiz">
                            </div>
                        </div>
                    </div>

                    <div class="checkbox">
                        <div class="row">
                            <div class="col-md-4">
                                <label><input type="checkbox" name="is_random_question"> Random questions</label>
                            </div>
                            <div class="col-md-4 text-center">
                                <label><input type="checkbox" name="is_random_answer"> Random answers</label>
                            </div>
                            <div class="col-md-4 text-right">
                                <label><input type="checkbox" name="is_redo"> Allow redo</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="submit-container">
                        <button type="submit" class="btn-submit bg-main">Tạo</button>
                    </div>
                    <br>
                    <br>
                </form>
            </div>


        </div>
        <div class="quiz_code_container hidden login-content box-shadow">
            <div class="title text-center">
                <h3>TẠO BÀI THI THÀNH CÔNG</h3>
            </div>
            <br>
            <div class="quiz_code_content text-center">
                <h5>QUIZ'S CODE:</h5>
                <h2 id="quiz_code" class="text-success"></h2>
                <span class="text-danger">Chỉ ai có quiz code này mới có quyền tham gia bài thi</span>
            </div>
        </div>
    </div>
</div>
<script src="/media/libs/js/xlsx.js"></script>
<script src="/media/js/add_quiz.js"></script>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>