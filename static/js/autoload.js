function autocomplete(inputElem, destination, url, callFun) {
    var currentFocus;
    inputElem.addEventListener('input', function(e) {
        var divElem, innerDiv, i, val = this.value;
        closeList();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        divElem = document.createElement("div");
        divElem.setAttribute("class", "autocomplete-items");
        divElem.setAttribute("id", this.id + "autocomplete-list");
        this.parentNode.appendChild(divElem);
        let selected = destination == null ? "" : ("/" + destination.getElementsByTagName('input')[0].value);
        fetch(url + val + selected, { headers: { response: "application/json" } })
            .then(response => { return response.json() })
            .then(data => {
                for (i = 0; i < data.result.length; i++) {
                    innerDiv = document.createElement("div");
                    innerDiv.innerHTML += data.result[i]['value'];
                    innerDiv.innerHTML += "<input type='hidden' value='" + data.result[i]['code'] + "'>";
                    innerDiv.innerHTML += "<input type='hidden' value='" + data.result[i]['value'] + "'>";
                    innerDiv.addEventListener("click", function(e) {
                        let selectedValues = destination == null ? null : destination.getElementsByTagName('input')[0].value;
                        let dataCode = this.getElementsByTagName("input")[0].value;
                        let dataValue = this.getElementsByTagName("input")[1].value;
                        if (destination != null) {
                            if (!selectedValues.includes(dataCode + ",")) {
                                destination.innerHTML += '<span class="list-group-item" id="list-group-item-' + dataCode + '" data-value="' + dataCode + '">' + dataValue + ' <span class="badge" onclick="removeItem(event, \'\');" data-id="' + dataCode + '">X</span></span>';
                                destination.getElementsByTagName('input')[0].value += dataCode + ",";
                            }
                            inputElem.value = "";
                            if (callFun != null)
                                callFun(dataValue, dataCode);
                        } else {
                            inputElem.value = dataValue;
                            if (callFun != null)
                                callFun(dataValue, dataCode);
                        }
                        closeList();
                    });
                    divElem.appendChild(innerDiv);
                }

            });
    });
    inputElem.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) {
                    x[currentFocus].click();
                }
            }
        }
    });

    function addActive(x) {
        if (!x) {
            return false;
        }
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeList() {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            x[i].parentNode.removeChild(x[i]);
        }
    }
    document.addEventListener("click", function(e) {
        closeList();
    });
}

function removeItem(event, elem) {
    let remove = event.target.getAttribute('data-id') + ",";
    let authors = event.target.parentElement.parentElement.getElementsByTagName('input')[0].value;
    event.target.parentElement.parentElement.getElementsByTagName('input')[0].value = authors.replace(remove, "");
    event.target.parentElement.remove();
}