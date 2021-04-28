function deleteItem(delUrl) {
    AskConfirm("Are sure to delete..?", () => fetch(delUrl, {
            method: 'DELETE',
            headers: {
                response: "application/json"
            }
        })
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
    status = event.target.checked ? 1 : 0;
    // const formData = new FormData();
    // formData.append('status', status);
    data = {
            "status": status
        }
        // statusChangeUrl += "/" + flag;
    console.log(statusChangeUrl);
    fetch(statusChangeUrl, {
            method: 'PUT',
            headers: {
                response: "application/json",
            },
            body: JSON.stringify(data)
        })
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
        "ordering": false
    });
}

function changeReport(url) {
    let list = document.getElementById('list').value;
    let sDate = document.getElementById('sDate').value;
    sDate = sDate == '' ? '0000-00-00' : sDate;
    let eDate = document.getElementById('eDate').value;
    url = url + "/" + list + '?sDate=' + sDate + '&eDate=' + eDate;
    window.location.replace(url);
}