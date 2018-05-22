$(document).ready(function() {
    let allQuizs = [];

    const uploadTable = data => {
        let html = ``;
        data.forEach(quiz => {
            html += `
                <tr role="row">
                    <td class="checkboxUser">
                        <input type="checkbox" name="">
                    </td>
                    <td>
                        ${quiz.quiz_id}
                    </td>
                    <td>
                        ${quiz.quiz_name}
                    </td>
                    <td>
                        ${quiz.subject_id}
                    </td>
                    <td>
                        ${quiz.quiz_type_id == "1" ? "Public" : "Private"}
                    </td>
                    <td>
                       ${quiz.quiz_status == "1" ? "Accepted" : "Pending"}
                    </td>
                    <td  class="btn-act" class="pull-right">
                        <button id="btnChangeStatus-${quiz.quiz_id}-${quiz.quiz_status}" type="button" class="btn btn-${quiz.quiz_status == "1" ? "danger" : "primary"}">
                            <i class="fa fa-${quiz.quiz_status == "1" ? "lock" : "unlock"}"></i>
                        </button>
                    </td>
                </tr>
            `
        })

        $("#tbody-quizs").html(html);
    }

    const getAll = () => {
        const url = "?pr=admin/quiz/getAll";
        $.ajax({
            type: "GET",
            url,
            dataType: "JSON",
            success: function(data) {
                if (data.length > 0) {
                    uploadTable(data);
                    allQuizs = data;
                }
            }
        });
    }
    
    const init = () => {
        getAll();
        $("#table_quizs").off('click').on("click", ".btn-act button", function() {
            const idQuiz = this.id.split("-")[1];
            const quizStatus = this.id.split("-")[2];
            
            $.ajax({
                type: "POST",
                url: "?pr=admin/quiz/toggleStatus",
                 data: {
                    quiz_id: parseInt(idQuiz, 10),
                    quiz_status: 1 - parseInt(quizStatus, 10), 	
                 },
                dataType: "JSON",
                success: function(data) {
                    if (data.success) {
                        getAll();
                    }
                }
            });        
        })
    }

    init();
})