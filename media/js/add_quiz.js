$(document).ready(function() {
    $("#form_type_quiz input").on("click", e => {
        const key = $(e.target).attr("key"); 
        if (key == "1") $("#form-start-end-time-quiz").slideDown(200);
        else $("#form-start-end-time-quiz").slideUp(200);
    })

    $("#form_add_quiz").on("submit", e => {
        e.preventDefault();
        const name = $("#form_add_quiz #name").val();
        const description = $("#form_add_quiz #description").val();
        const subject_id = $("#form_add_quiz #typemon").val();

        const max_time = $("#form_add_quiz #maxtime").val();
        const total_score = $("#form_add_quiz #total_score").val();
        const type_quiz  = $("#form_add_quiz #form_type_quiz input:checked").attr("key");
        const start_time_quiz = $("#form_add_quiz #start_time_quiz").val();
        const end_time_quiz = $("#form_add_quiz #end_time_quiz").val();
        const is_random_questions = $("#form_add_quiz input[name=is_random_questions]").prop('checked');
        const is_random_answers = $("#form_add_quiz input[name=is_random_answers]").prop('checked');
        const is_redo = $("#form_add_quiz input[name=is_redo]").prop('checked');

        const data = {
            name,
            description,
            subject_id,
            max_time,
            total_score,
            type_quiz,
            start_time_quiz,
            end_time_quiz,
            is_random_questions,
            is_random_answers,
            is_redo,
        }
        console.log(data);
    })
});