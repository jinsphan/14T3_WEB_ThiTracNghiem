$(document).ready(function () {

    let dataFile = [];

    $("#form_quiz_type input").on("click", e => {
        const key = $(e.target).attr("key");
        if (key == "1") $("#form-start-end-time-quiz").slideDown(200);
        else $("#form-start-end-time-quiz").slideUp(200);
    })


    $("#form_add_quiz").on("submit", e => {
        e.preventDefault();
        const quiz_name = $("#form_add_quiz #quiz_name").val();
        const description = $("#form_add_quiz #description").val();
        const subject_id = $("#form_add_quiz #subject_id").val();

        const max_time = $("#form_add_quiz #max_time").val();
        const max_score = $("#form_add_quiz #max_score").val();
        const quiz_type_id = $("#form_add_quiz #form_quiz_type input:checked").attr("key");
        const datetime_start = $("#form_add_quiz #start_time_quiz").val();
        const datetime_finish = $("#form_add_quiz #end_time_quiz").val();
        const is_random_question = $("#form_add_quiz input[name=is_random_question]").prop('checked');
        const is_random_answer = $("#form_add_quiz input[name=is_random_answer]").prop('checked');
        const is_redo = $("#form_add_quiz input[name=is_redo]").prop('checked');

        const data = {
            quiz_name,
            description,
            subject_id,
            max_time,
            max_score,
            quiz_type_id,
            datetime_start,
            datetime_finish,
            is_random_question,
            is_random_answer,
            is_redo,
            xlsx_data: dataFile,
        }
        console.log(data);
        $.ajax({
            url: "/quiz/create",
            method: 'POST',
            data,
            dataType: "JSON",
            success: (data) => {
                console.log(data);
            },
        })
    });

    const ExcelExport = function (event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function () {
            var fileData = reader.result;
            var wb = XLSX.read(fileData, { type: 'binary' });

            wb.SheetNames.forEach(function (sheetName) {
                var rowObj = XLSX.utils.sheet_to_row_object_array(wb.Sheets[sheetName]);
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