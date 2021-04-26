<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>User Request for Books
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
                                <th>Requested Date</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th data-orderable="false">Action</th>
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
    document.getElementById('request').className += " active";
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
            "data": "requestedAt"
        },
        {
            "data": "comments"
        },
        {
            "data": "status"
        },
        {
            "data":null,
            "render": function(item) {   
                code = ' <a type="button" href="/userRequest/'+item.id+'"';
                code += ' class="button-control icon-btn positive" title="edit"><i';
                code += ' class="fa fa-edit"></i></a>';
                return code;
            }
        },
    ]
    $(document).ready(function() {
        loadTableData("book-list", "/requestBook/loadData", column);
    });
</script>