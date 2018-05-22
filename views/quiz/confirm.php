<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/start.css" rel="stylesheet">

<div class="start-container">
    <div class="container">
        <div class="start-content box-shadow text-center">
            <?php 
                if(isset($this->error)) {
                    echo "<h3>".$this->error."</h3>";
                    include_once 'views/layout/'.$this->layout.'footer.php';
                    die();
                }
                
            ?>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="cl-main text-center"><?= $this->quiz_data["quiz_name"] ?></h3>
                    <h4 style="padding: 0 20%;" class="text-center"><?= $this->quiz_data["description"] ?></h4>
                    <br>
                    <div class="text-center">
                        <img style="width: 100px; height: 100px" src="/media/img/subjects/toan.png" alt="">
                    </div>
                    <h4 class="text-center text-danger">Bài thi được mở từ: <strong><?= $this->quiz_data["datetime_start"] ?></strong> đến <strong><?= $this->quiz_data["datetime_finish"] ?></strong></h4>
                    <h5 class="text-center text-danger">Một khi đã bắt đầu, bạn không thể quay lại cho đến khi nộp bài!</h5>
                    <div class="text-center">
                        <a href="
                            <?php 
                                echo html_helper::url([
                                    "ctl" => "quiz", 
                                    "act" => "start",
                                    "params" => [
                                        "quiz_id" => $this->quiz_id,
                                        "s" => $this->s
                                    ]
                                ]); 
                        ?>" class="btn btn-danger">Xác nhận làm bài</a>
                        <a href="" class="btn btn-info">Quay lại</a>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <h4><Html>Lịch sử thi</Html></h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Số câu đúng</th>
                            <th>Số câu sai</th>
                            <th>Tổng điểm</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($this->history as $key => $item) {  ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
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
    </div>
</div>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>