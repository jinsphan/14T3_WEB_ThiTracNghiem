<div class="col-md-6">
    <div class="exam-item-container">
        <div class="row">
            <div class="col-md-4">
                <div class="exam-cover-item">
                    <img src="/media/img/subjects/toan.png" alt="">
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="title"><a href="/quiz/confirm/quiz_id=<?= $quiz["quiz_id"] ?>"><?= $quiz["quiz_name"] ?></a></h4>
                <p class="description" ><?= $quiz["description"] ?></p>
                <div class="info">
                    <!-- <span class="item-info">
                        <i class="fas fa-user"></i> Jr Tinh
                    </span>

                    <span class="item-info">
                        	<i class="fas fa-tag"></i> Toan
                    </span> -->

                    <span class="item-info">
                        <i class="far fa-clock"></i> <?= $quiz["date_created"] ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>