<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/start.css" rel="stylesheet">

<div class="start-container">
    <form id="form-quiz-start" quizId="<?= isset($this->quiz_data["quiz_id"]) ? $this->quiz_data["quiz_id"] : "" ?>">
        <div class="container">
            <div class="start-name-quiz text-center">
                <h3><?= isset($this->quiz_data["quiz_name"]) ? $this->quiz_data["quiz_name"] : "" ?></h3>
            </div>
            <?php if (!isset($this->error)) { ?>
            <div id="tesst_quiz_content" class="start-content box-shadow">
                <div class="time-countdown">
                    <div class="title bg-main">Thời gian còn lai</div>
                    <div id="time-countdown" class="time">
                        00:00:00
                    </div>
                    <script>
                        let _s = "<?= $this->s ?>"
                        let time_completed = 0;
                        let max_time = "<?= $this->quiz_data["max_time"] ?>";
                        max_time = max_time.split(":");
                        max_time = {
                            h: +max_time[0],
                            m: +max_time[1],
                            s: +max_time[2],
                        };
                        const interval_countdown = setInterval(() => {
                            if (max_time.s === 0) {
                                max_time.s = 60;
                                if (max_time.m === 0) {
                                    max_time.m = 59;
                                    max_time.h = max_time.h - 1;
                                } else {
                                    max_time.m = max_time.m - 1;
                                }
                            }

                            max_time.s = max_time.s - 1 ;
                            time_completed++;

                            $("#time-countdown").text(`${max_time.h}:${max_time.m}:${max_time.s}`);

                            if ((max_time.h + max_time.m + max_time.s) <= 0) {
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
                            <span>(<?= round($this->quiz_data["max_score"] / count($this->quiz_data["questions"]), 2)  ?> điểm)</span>
                        </div>
                    </div>
                    <div class="question-content">
                        <p class="p"><?= $question["question_description"] ?></p>
                        <div class="anserwers-content">
                            <?php foreach($question["answers"] as $index_as => $answer) { ?>
                            <div>
                                <input name="<?= $question["question_id"] ?>" type="<?= $question["is_many_answers"] === "1" ? "checkbox" : "radio" ?>" value="<?= $answer["answer_id"] ?>" id="<?= $index . "-". $index_as ?>"> <label for="<?= $index . "-". $index_as ?>"><?= $answer["answer_description"] ?></label>
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
            <?php } else { ?>
                <div class="start-content box-shadow">
                    <h1 class="text-center text-danger"><?= $this->error ?></h1>
                </div>
            <?php } ?>
            
            <div id="result_quiz_content" class="start-content box-shadow text-center hidden">
                <h1 class="text-center text-success">Chúc mừng bạn đã hoàn thành bài thi</h1>
                <h3 class="text-center text-primary">Kết quả:</h3>
                <h4>Số câu đúng: <span id="num_correct_answers" class="text-success"></span></h4>
                <h4>Số câu sai: <span id="num_wrong_answers" class="text-danger"></span></h4>
                <h4>Tổng điểm: <strong id="total_score"></strong></h4>
            </div>
        </div>
    </form>
</div>
<script src="/media/js/quiz.js"></script>

