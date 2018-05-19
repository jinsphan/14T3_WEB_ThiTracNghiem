$(document).ready(function() {
    
    const nopBai = (quiz_id, result) => {
        clearInterval(interval_countdown);
        const data = {
            quiz_id,
            results: result.reduce((cur, next) => {
                return [
                    ...cur,
                    {
                        question_id: next.name,
                        answers: [next.value]
                    }
                ]
            }, [])
        }
        console.log(data);
    }
    
    
    $("#form-quiz-start").on("submit", function(e) {
        e.preventDefault();
        
        const quiz_id = $(this).attr("quizId");
        const result = $( this ).serializeArray();
        
        nopBai(quiz_id, result);
    })
})