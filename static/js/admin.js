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

function loadTableData(id, url, columns) {
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
        "columnDefs": [
            // { "orderable": false, "targets": [0, columns.length] },
            // { "orderable": true, "targets": [1, 2, 3] }
        ]
    });
}