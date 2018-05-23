<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<link href="<?php echo RootREL; ?>media/css/main.css" rel="stylesheet">

<div class="quizs_management inner-container">
    <div class="container">
        <div class="inner-content">
            <div class="title-inner">
                <h3>Danh sách người dùng đã tham gia</h3>
            </div>

            <br>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>USERNAME</th>
                    <th>FULLNAME</th>
                    <th>QUIZ NAME</th>
                    <th>NUM OF WRONG</th>
                    <th>NUM OF CORRECT</th>
                    <th>TOTAL SCORE</th>
                    <th>DATE</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->history_data as $key => $value) { ?>
                <tr>
                    <td><?= $value["username"] ?></td>
                    <td><?= $value["fullname"] ?></td>
                    <td><?= $value["quiz_name"] ?></td>
                    <td><?= $value["num_of_wrong"] ?></td>
                    <td><?= $value["num_of_correct"] ?></td>
                    <td><?= $value["total_score"] ?></td>
                    <td><?= $value["date_created"] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>