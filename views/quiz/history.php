<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/login.css" rel="stylesheet">
<link href="<?php echo RootREL; ?>media/css/quiz.css" rel="stylesheet">

<div class="login-container">
    <div class="container">
        <div class="create_quiz_container login-content box-shadow">
            <div class="title-login">
                <h3>LỊCH SỬ THI</h3>
            </div>

            <br>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Stt</th>
                    <th>Quiz id</th>
                    <th>Số câu đúng</th>
                    <th>Số câu sai</th>
                    <th>Tổng điểm</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->histories as $key => $item) {  ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $item["quiz_id"] ?></td>
                        <td><?= $item["num_of_correct"] ?></td>
                        <td><?= $item["num_of_wrong"] ?></td>
                        <td><?= round($item["total_score"], 3) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>