const es = new EventSource("/books/bookstatus");

es.onmessage = function(e) {
    msgs = e.data.split(",");
    for (const msg of msgs) {
        let data = msg.split("-");
        let status = data[1];
        let book = data[0];
        let ele = document.getElementById("b#"+book);
        console.log("b#"+book);
        if (ele != null) {
            if (status) {
                ele.style.color = "orange";
            } else {
                ele.style.color = "black";
            }
        }
    }
};
