<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/start.css" rel="stylesheet">

<div class="start-container">
    <div class="container">
        <div class="start-content box-shadow">
            <div class="text-center">
                <?php 
                    if(isset($this->error)) {
                        echo "<h3>".$this->error."</h3>";
                        include_once 'views/layout/'.$this->layout.'footer.php';
                        die();
                    }
                    
                ?>
                <h3>Một khi đã bắt đầu, bạn không thể quay lại cho đến khi nộp bài!</h3>
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
    </div>
</div>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>