<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Books &nbsp;<a class="btn-link" href="/books/add">Add</a></h1>
                    <hr>
                </div>
            </div>
            <div class="div-card-body">
                <div style="overflow-x:auto;">
                    <table id="book-list" class="tab_design">
                        <thead>
                            <tr>
                                <th data-orderable="false">Sl. No</th>
                                <th>Book</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Status</th>
                                <th data-orderable="false">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table_body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
    document.getElementById('books').className += " active";
    column = [{
            "render": function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "name"
        },
        {
            "data": "createdAt"
        },
        {
            "data": "updatedAt"
        },
        {
            "data": null,
            "render": function(item) {
                code = '<div class="checkbox"><input type="checkbox" ';
                code += 'onchange="changeStatus(event,'
                code += "'/books/changeStatus/" + item.id + "');" + '" ';
                code += item.status == 1 ? "checked" : '';
                code += '></div>';
                return code;
            }
        },
        {
            "data": null,
            "render": function(item) {
                code = '<a href=';
                code += "'/books/edit/" + item.id + "'";
                code +=
                    'class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></a> <button type="button"';
                code += ' onclick="deleteItem(' + "'/books/delete/" + item.id + "');" + '"';
                code +=
                    'class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>';
                return code;
            }
        }
    ]
    $(document).ready(function() {
        loadTableData("book-list", "/book/loadData", column);
    });
</script>