<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Users</h1>
                    <hr>
                </div>
            </div>
            <div class="div-card-body">
                <div style="overflow-x:auto;">
                    <table id='user-list' class="tab_design">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Registered At</th>
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
    document.getElementById('manageUsers').className += " active";
    column = [{
            "render": function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "fullName"
        },
        {
            "data": "userName"
        },
        {
            "data": "email"
        },
        {
            "data": "mobile"
        },
        {
            "data": "createdAt"
        }
    ]
    $(document).ready(function() {
        loadTableData("user-list", "/allRegUser/loadData", column);
    });
</script>