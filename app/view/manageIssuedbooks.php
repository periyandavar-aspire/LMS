<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Issued Book Entry</h1>
                    <hr>
                </div>
            </div>
            <form action="/issueBook" onsubmit="issueBookFormValidator(event);" enctype="multipart/form-data"
                method="post">
                <div class="row">
                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>User Name <span class="required-star">*</span></label>
                            <input class="form-control" autocomplete="off" type="text" id="username" name="username"
                                placeholder="User Name" required="">
                        </div>
                    </div>

                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>User Details</label>
                            <div class="form-control div-like-textarea disabled" id="userdetails"></div>
                            <input type="hidden" value="0" id="user-condition">
                        </div>
                    </div>

                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>ISBN Number <span class="required-star">*</span></label>
                            <input pattern="^[0-9]+$" class="form-control" autocomplete="off" type="text"
                                id="isbnNumber" name="isbnNumber" placeholder="Book Name" required="">
                        </div>
                    </div>

                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>Book Details</label>
                            <div class="form-control div-like-textarea disabled" id="bookdetails"></div>
                            <input type="hidden" value="0" id="book-condition">
                        </div>
                    </div>

                    <div class="cols col-9">
                        <div class="form-input-div">
                            <label>Comments (If any)</label>
                            <textarea class="form-control" id="comments" name="comments"
                                placeholder="comments"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-link">Add</button>
                </div>
        </div>
        </form>
        </div>
    </section>

    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Issued Books
                        <!-- &nbsp;<a class="btn-link" href="/admin/issueBook">New Entry</a> -->
                    </h1>
                    <hr>
                </div>
            </div>
            <div class="div-card-body">
                
                <div style="overflow-x:auto;">
                    <table class="tab_design" id='book-list'>
                        <thead>
                            <tr>
                                <th data-orderable="false">Sl. No</th>
                                <th>ISBN Number</th>
                                <th>Book Name</th>
                                <th>User Name</th>
                                <th>Issued Date</th>
                                <th>Returned Date</th>
                                <th>Status</th>
                                <th>Fine Amount</th>
                                <th data-orderable="false">Mark as Returned</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </section>
</article>
<script>
    document.getElementById('issued').className += " active";
    autocomplete(document.getElementById("username"), null, "/user/get/", loadUserDetails);
    autocomplete(document.getElementById("isbnNumber"), null, "/book/get/", loadBookDetails);
    column = [{
            "render": function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "isbnNumber"
        },
        {
            "data": "bookName"
        },
        {
            "data": "userName"
        },
        {
            "data": "issuedAt"
        },
        {
            "data": "returnedAt"
        },
        {
            "data": "status"
        },
        {
            "data": "fine"
        },
        {
            "data":null,
            "render": function(item) {
                if (item.status == 'Issued') {
                    code = '<button type="button" onclick="MarkasReturn('+item.id+');"';
                    code += 'class="button-control icon-btn positive" title="Mark as Returned"><i class="fa fa-check"';
                    code += 'aria-hidden="true"></i></button>';
                    return code;
                }
                else 
                    return item.status;
            }
        },
    ]
    $(document).ready(function() {
        loadTableData("book-list", "/issueBook/loadData", column);
    });
</script>