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