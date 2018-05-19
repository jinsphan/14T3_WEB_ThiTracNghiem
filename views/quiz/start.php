<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/start.css" rel="stylesheet">

<div class="start-container">
    <form id="form-quiz-start" quizId="<?= $this->quiz_data["quiz_id"] ?>">
        <div class="container">
            <div class="start-name-quiz text-center">
                <h3>Toán lớp 1 - Đề kiểm tra 15 phút - Tháng 8 Miễn phí</h3>
            </div>
            <div class="start-content box-shadow">
                <div class="time-countdown">
                    <div class="title bg-main">Thời gian còn lai</div>
                    <div id="time-countdown" class="time">
                        00:00
                    </div>
                    <script>
                        let max_time = "<?= $this->quiz_data["max_time"] ?>";
                        max_time = max_time.split(":");
                        max_time = {
                            h: +max_time[0],
                            m: +max_time[1],
                            s: +max_time[2],
                        };
                        const interval_countdown = setInterval(() => {
                            if (max_time.s === 0) {
                                max_time.s = 59;
                                max_time.m = max_time.m - 1;
                            } else {
                                max_time.s = max_time.s - 1 ;
                            }

                            $("#time-countdown").text(`${max_time.m}:${max_time.s}`);

                            if ((max_time.h + max_time.m + max_time.s) === 0) {
                                $("#form-quiz-start").submit();
                            }
                        }, 1000);
                    </script>
                </div>
                <?php foreach($this->quiz_data["questions"] as $index => $question) { ?>
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
                        <p class="p"><?= $question["question_description"] ?></p>
                        <div class="anserwers-content">
                            <?php foreach($question["answers"] as $index_as => $answer) { ?>
                            <div>
                                <input name="<?= $question["question_id"] ?>" type="radio" value="<?= $answer["answer_id"] ?>" id="<?= $index . "-". $index_as ?>"> <label for="<?= $index . "-". $index_as ?>"><?= $answer["answer_description"] ?></label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="btn-submit">
                    <button id="btn-submit-quiz" class="btn-v2">Nộp bài</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="/media/js/quiz.js"></script>

