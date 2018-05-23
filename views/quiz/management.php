<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/main.css" rel="stylesheet">

<div class="quizs_management inner-container">
    <div class="container">
        <div class="inner-content">
            <div class="title-inner">
                <h3>QUẢN LÍ BÀI THI</h3>
            </div>

            <br>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>QUIZ ID</th>
                    <th>QUIZ NAME</th>
                    <th>QUIZ CODE</th>
                    <th>QUIZ TYPE</th>
                    <th>TIME START</th>
                    <th>TIME FINISH</th>
                    <th>MAX SCORE</th>
                    <th>MAX TIME</th>
                    <th>STATUS</th>
                    <th>ACCOUNTS PARTICIPATED</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->quizs_data as $key => $quiz_data) { ?>
                <tr>
                    <td><?= $quiz_data["quiz_id"] ?></td>
                    <td><?= $quiz_data["quiz_name"] ?></td>
                    <td><?= $quiz_data["quiz_code"] ?></td>
                    <td><?= $quiz_data["quiz_type_id"] == "1" ? "Private" : "Public" ?></td>
                    <td><?= $quiz_data["datetime_start"] ?></td>
                    <td><?= $quiz_data["datetime_finish"] ?></td>
                    <td><?= $quiz_data["max_score"] ?></td>
                    <td><?= $quiz_data["max_time"] ?></td>
                    <td><?= $quiz_data["quiz_status"] == "1" ? "Accepted" : "Pendding" ?></td>
                    
                    <td>
                        <a class="btn btn-info" href="/quiz/account_participated/quiz_id=<?=$quiz_data["quiz_id"] ?>/s=<?=$this->s?>"><i class="fas fa-eye-alt"></i></a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="text-right">
                <ul class="pagination">
                    <?php for($i = 1; $i <= ceil($this->total_quizs/5); $i++ ){ ?>
                    <li><a href="/quiz/management/page=<?= $i ?>"><?= $i ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>