function requestBook(book, available) {
    if (available == 0) {
        toast("This book is not available", 'danger');
        return false;
    }
    fetch("/book/request/" + book, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            if (data.result == 1) {
                toast('The request is sent successfully..!', 'success');
            } else {
                toast(data.msg, 'danger');
            }
        });
}

function deleteItem(delUrl) {
    AskConfirm("Are sure to delete..?", () => fetch(delUrl, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            if (data.result == 1) {
                parts = delUrl.split("/");
                document.getElementById(parts[parts.length - 1]).remove();
                toast("The Request is deleted successfully..!", 'success');
            } else {
                toast("Unable to delete the request..!", 'danger');
            }
        }));
}

function changePagination(url) {
    let limit = document.getElementById('recordCount').value;
    let search = document.getElementById('recordSearch').value;
    let offset = 0;
    limit = isNaN(limit) ? 5 : limit;
    url = url + "?index=" + offset + "&limit=" + limit + "&search=" + search;
    window.location.replace(url);
    // console.log(url);
}