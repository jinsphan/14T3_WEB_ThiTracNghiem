$(document).ready(function() {
    
    const nopBai = (quiz_id, result) => {
        clearInterval(interval_countdown);
        let data = {
            quiz_id,
            results: result.reduce((cur, next) => {
                return {
                    ...cur,
                    [next.name]: {
                        question_id: next.name, 
                        answers: [...(cur[next.name] ? cur[next.name].answers : []), next.value]
                    }
                }
            }, {}),
            s: _s,
            time_completed,
        }
        $.ajax({
            url: "/quiz/finish",
            method: "POST",
            dataType: "JSON",
            data,
            success: res => {
                console.log(res);
                const {
                    num_of_correct,
                    num_of_wrong,
                    total_score,
                } = res.data[0];
                if (res.success === 1) {
                    $("#tesst_quiz_content").hide(100);
                    $("#result_quiz_content").removeClass("hidden");
                    $("#result_quiz_content #num_correct_answers").text(num_of_correct);
                    $("#result_quiz_content #num_wrong_answers").text(num_of_wrong);
                    $("#result_quiz_content #total_score").text(total_score);
                }
            }
        })
    }
    
    
    $("#form-quiz-start").on("submit", function(e) {
        e.preventDefault();
        
        const quiz_id = $(this).attr("quizId");
        const result = $( this ).serializeArray();
        
        nopBai(quiz_id, result);
    })
})
