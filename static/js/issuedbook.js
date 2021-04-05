function loadUserDetails(event) {
    let username = event.target.value;
    fetch("/admin/userDetails/" + username, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => updateUserDetails(document.getElementById('userdetails'), data));
}

function loadBookDetails(event) {
    let isbn = event.target.value;
    fetch("/admin/bookDetails/" + isbn, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => updateBookDetails(document.getElementById('bookdetails'), data));
}

function updateUserDetails(elem, data) {
    let value = "" //data['userName'];
    value += data['fullName'];
    value += "\n" + data['mobile'];
    value += "\n" + data['email'];
    elem.value = value;
}

function updateBookDetails(elem, data) {
    let value = '';
    imgContainer = document.createElement('div');
    imgContainer.setAttribute('class', 'img-wrapper');
    txtContainer = document.createElement('div');
    txtContainer.setAttribute('class', 'text-wrapper');
    imgElem = document.createElement('img');
    imgElem.src = "/upload/book/" + data['coverPic'];
    value += data['name'];
    value += "<br>" + data['location'];
    value += "<br>" + data['publication'];
    value += "<br> Rs." + data['publication'];
    txtContainer.innerHTML = value;
    imgContainer.appendChild(imgElem);
    elem.appendChild(imgContainer);
    elem.appendChild(txtContainer);
}