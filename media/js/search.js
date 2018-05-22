$(document).ready(function() {

    const getHtmlQuizItem = quiz => {
        const html = `<div class="col-md-6">
                        <div class="exam-item-container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="exam-cover-item">
                                        <img src="/media/img/subjects/toan.png" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="title"><a href="/quiz/confirm/quiz_id=${quiz.quiz_id}">${quiz.quiz_name}</a></h4>
                                    <p class="description" >${quiz.description}</p>
                                    <div class="info">
                                        <span class="item-info">
                                            <i class="far fa-clock"></i> ${quiz.date_created}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    
        `;
        return html;        
    }

    const updateHomeContent = data => {
        console.log(data);
        const html = data.reduce((cur, next, index) => {
            if (index % 2 === 0) {
                return `
                    ${cur}
                    <div class="row">
                        ${getHtmlQuizItem(next)}
                        ${data[index + 1] !== undefined ? getHtmlQuizItem(data[index + 1]) : ""}
                    </div>
                `;
            }
            return cur;
        }, "");
        console.log(html);
        $(".home-container .home-content").html(html);
    }

    $("#form_search_quizs input").on("keyup", function(e) {
        const url = `/quiz/search/keyword=${e.target.value}`;
        $.ajax({
            url,
            method: "POST",
            dataType: "JSON",
            success: res => {
                updateHomeContent(res);
            }
        })
    })
})