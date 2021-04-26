function deleteItem(delUrl) {
    AskConfirm("Are sure to delete..?", () => fetch(delUrl, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            if (data.result == 1) {
                parts = delUrl.split("/");
                document.getElementById(parts[parts.length - 1]).remove();
                toast("The item deleted successfully..!", 'success');
            } else {
                msg = data.msg != undefined ? data.msg : "Unable to delete the item..!";
                toast(msg, 'danger');
            }
        }));
}

function editItem(editUrl, element = "editRecord") {
    fetch(editUrl, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            openModal(element);
            for (const key in data.data) {
                console.log(key);
                document.getElementById("edit-" + key).value = data.data[key];
            }
        });
}

function changeStatus(event, statusChangeUrl) {
    flag = event.target.checked ? 1 : 0;
    statusChangeUrl += "/" + flag;
    fetch(statusChangeUrl, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            if (data.result == 1) {
                toast("The status updated successfully..!", 'success');
            } else {
                event.target.checked = !(event.target.checked);
                toast("Unable to upate the status..!", 'danger');
            }
        });
}
var buttonCommon = {
    exportOptions: {
        format: {
            body: function(data, row, column, node) {
                return data;
            }
        }
    }
}

function loadTableData(id, url, columns, title) {
    studentTable = jQuery('#' + id).dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        'destroy': true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "bProcessing": true,
        "bServerSide": true,
        "rowId": "id",
        "sAjaxSource": url,
        "columns": columns,
        dom: 'lBfrtip',
        buttons: [$.extend(true, {}, buttonCommon, {
            extend: 'print',
            text: 'Print',
            title: ' Details',
            className: 'print-btn',
            exportOptions: {
                columns: ':not(.notexport)'
            },
            customize: function(win) {
                $(win.document.body)
                    .css('font-size', '10pt')
                    .css('margin', '12px')
                    .prepend(
                        '<img src="http://lms.com/static/img/favicon.png" style="height:50px; top:10; left:10;" /> LMS'
                    );

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit')
                    .css('margin', '9px')
            }

        })]
    });
}

function changeReport(url) {
    let list = document.getElementById('list').value;
    let sDate = document.getElementById('sDate').value;
    sDate = sDate == '' ? '0000-00-00' : sDate;
    let eDate = document.getElementById('eDate').value;
    url = url + "/" + list + '/' + sDate + '/' + eDate;
    window.location.replace(url);
}