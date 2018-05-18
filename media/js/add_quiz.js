$(document).ready(function() {

    let dataFile = [];

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
            xlsx_data: dataFile,
        }
        console.log(data);
    });

    const ExcelExport= function (event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var fileData = reader.result;
            var wb = XLSX.read(fileData, {type : 'binary'});

            wb.SheetNames.forEach(function(sheetName){
                var rowObj =XLSX.utils.sheet_to_row_object_array(wb.Sheets[sheetName]);
                var jsonObj = JSON.stringify(rowObj);
                console.log(JSON.parse(jsonObj));
                dataFile = JSON.parse(jsonObj);
            })
        };
        reader.readAsBinaryString(input.files[0]);
    };

    const fi = document.getElementById("filequestion");
    fi.addEventListener("change", e => {
        // 
        if (e.target.files[0].type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            ExcelExport(e);
        } else {
            alert("Please insert correct files");
            fi.value = "";
        }
    })
});