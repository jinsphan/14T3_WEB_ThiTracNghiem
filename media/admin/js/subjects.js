$(document).ready(function() {
    let allSubjects = [];

    const get_modal = () => {
        const data = {
            subject_id: $("#modal-subject #subject_id-modal input").val(),
            subject_name: $("#modal-subject #subject_name-modal input").val(),
            description: $("#modal-subject #description-modal input").val(),
            subject_status: $("#modal-subject #subject_status-modal select option:selected").attr("value"),
            parent_subject_id: $("#modal-subject #parent_subject_id-modal select option:selected").attr("value"),
        }
        return data;
    }

    const fill_modal = (subject) => {
        const allParentSubjectHtml = allSubjects.reduce((cur, next) => {
            if (next.subject_id == subject.subject_id) return cur;
            return `
                ${cur}
                <option ${next.parent_subject_id == subject.subject_id ? "selected" : ""} value="${next.subject_id}">${next.subject_name}</option>
            `;
        }, "");

        const html = `
            <tr id="subject_id-modal" class="row">
                <td class="col-sm-4">Subject id</td>
                <td class="col-sm-8"><input readOnly class='form-control' type="text" value="${subject.subject_id}"></td>
            </tr>
            <tr id="subject_name-modal" class="row">
                <td class="col-sm-4">Subject name</td>
                <td class="col-sm-8"><input class='form-control' type="text" value="${subject.subject_name}"></td>
            </tr>
            <tr id="description-modal" class="row">
                <td class="col-sm-4">Description</td>
                <td class="col-sm-8"><input class='form-control' type="text" value="${subject.description}"></td>
            </tr>
            <tr id="subject_status-modal" class="row">
                <td class="col-sm-4">Status</td>
                <td class="col-sm-8">
                    <div class='form-group'>
                        <select class='form-control'>
                            <option value="0" ${subject.subject_status == "0" ? "selected" : ""}>Disable</option>
                            <option value="1" ${subject.subject_status == "1" ? "selected" : ""}>Enable</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr id="parent_subject_id-modal" class="row">
                <td class="col-sm-4">Parent</td>
                <td class="col-sm-8">
                    <div class='form-group'>
                        <select class='form-control' id='sel1'>
                            ${allParentSubjectHtml}
                        </select>
                    </div>
                </td>
            </tr>
        `;

        $("#modal-subject #modal-body").html(html);
    }

    const uploadTable = data => {
        let html = ``;
        data.forEach(subject => {
            html += `
                <tr role="row">
                    <td class="checkboxUser">
                        <input type="checkbox" name="">
                    </td>
                    <td>
                        ${subject.subject_id}
                    </td>
                    <td>
                        ${subject.subject_name}
                    </td>
                    <td>
                        ${subject.date_created}
                    </td>
                    <td>
                        ${subject.subject_status == "1" ? "Enabled" : "Disabled"}
                    </td>
                    <td  class="btn-act" class="pull-right">
                        <button id="btnEditSubject-${subject.subject_id}" type="button" class="btn btn-primary edit-user" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>
                </tr>
            `
        })
        $("#tbody-subjects").html(html);
    }

    const getAll = () => {
        const url = "?pr=admin/subject/readAll";
        $.ajax({
            type: "GET",
            url,
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                let _data = [];
                const readDequi = (data) => {
                    Object.keys(data).map(key => {
                        const item = data[key];
                        if (item.childs && Object.keys(item.childs).length > 0) {
                            readDequi(item.childs);
                        }
                        delete item.childs;
                        _data.push(item);
                    })
                }
                readDequi(data);
                uploadTable(_data);
                allSubjects = _data;
            }
        });
    }
    
    const init = () => {
        getAll();
        $("#table_subjects").off('click').on("click", ".btn-act button", function() {
            $("#modal-subject #btn-submit-add").hide(0);
            $("#modal-subject #btn-submit-update").show(0);
            const idSubject = this.id.split("-")[1];
            const url = "?pr=admin/subject/readByID/subject_id=" + idSubject;
            
            $.ajax({
                type: "GET",
                url,
                dataType: "JSON",
                success: function(data) {
                    if (data) {
                        fill_modal(data);
                    }
                }   
            });         
        })

        // Click add btn
        // Onclic update Modal subject

        $("#modal-subject #btn-submit-update").off("click").on("click", function() {
            const subjectEdit = get_modal();
            $("#modal-subject #btn-submit-add").hide(0);
            $.ajax({
                type: "POST",
                url: "?pr=admin/subject/update",
                dataType: "JSON",
                data: subjectEdit,
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        getAll();
                    }
                }
            });
        })

        // Add subject

        $("#add-subject").off("click").on("click", function() {
            const initSubject = {
                subject_id: "",
                subject_name: "",
                description: "",
                subject_status: 0,
                parent_subject_id: 0, 
            };

            $("#modal-title").text("Modal Add New Subject");
            $("#modal-subject #btn-submit-add").show(0);
            $("#modal-subject #btn-submit-update").hide(0);
            fill_modal(initSubject);
        })

        // Add Subject
        $("#modal-subject #btn-submit-add").off("click").on("click", function() {
            const dataAdd = get_modal();
            console.log(dataAdd);
            delete dataAdd.subject_id;
            delete dataAdd.subject_status;
            delete dataAdd.parent_subject_id;
            
            $.ajax({
                type: "POST",
                url: "?pr=admin/subject/create",
                dataType: "JSON",
                data: dataAdd,
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