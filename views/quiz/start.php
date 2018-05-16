<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/start.css" rel="stylesheet">

<div class="start-container">
    <div class="container">
        <div class="start-name-quiz text-center">
            <h3>Toán lớp 1 - Đề kiểm tra 15 phút - Tháng 8 Miễn phí</h3>
        </div>
        <div class="start-content box-shadow">
            <div class="time-countdown">
                <div class="title bg-main">Thời gian còn lai</div>
                <div class="time">
                    02:59
                </div>
            </div>
            <?php foreach($this->data_quiz as $index => $question) { ?>
            <div class="item-question">
                <div class="tag-num-question">
                    <div class="name-number">
                        <span>Câu <?= $index+1 ?>:</span>
                    </div>
                    <div class="score-question">
                        <span>(10 diem)</span>
                    </div>
                </div>
                <div class="question-content">
                    <p class="p"><?= $question["name_question"] ?></p>
                    <div class="anserwers-content">
                        <?php foreach($question["answers"] as $index_as => $answer) { ?>
                        <div>
                            <input name="<?= $index ?>" type="radio" id="<?= $index . "-". $index_as ?>"> <label for="<?= $index . "-". $index_as ?>"><?= $answer ?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="btn-submit">
                <button class="btn-v2">Nộp bài</button>
            </div>
        </div>
    </div>
</div>

