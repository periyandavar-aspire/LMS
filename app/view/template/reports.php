<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Analytics </h1>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class='cols col-1'>
                    <label> Between Dates </label>
                    <input type='date' value="<?php echo $sDate; ?>" onchange="changeReport('/report');" id='sDate' class='form-control'>
                </div>
                <div class='cols col-1'>
                    <label> &nbsp; <label>
                    <input type='date' value="<?php echo $eDate; ?>" onchange="changeReport('/report');" id='eDate' class='form-control'>
                </div>
                <div class='cols col-1'>
                    <label> Reports on </label>
                    <select onchange="changeReport('/report');" id='list' class='form-control select-input'>
                        <option value='book'> Top Books </option>
                        <option value='author'> Top Authors </option>
                        <option value='category'> Top Categories </option>
                        <option value='user'> Top Users </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="cols">
                    <div class="div-card-body">
                        <div style="overflow-x:auto;">
                            <table id="report-list" class="tab_design">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl. No</th>
                                        <?php if ($list== "book"): ?>
                                        <th>Book Name</th>
                                        <th>ISBN Number</th>
                                        <th>Categories</th>
                                        <th>Authors</th>
                                        <?php endif;?>
                                        <?php if ($list== "user"): ?>
                                        <th>User Name</th>
                                        <th>Full Name</th>
                                        <?php endif;?>
                                        
                                        <th data-orderable="false">Impression%</th>
                                    </tr>
                                </thead>
                                <tbody class="table_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
    document.getElementById("list").value = "<?php echo $list?>";
    if ("<?php echo $list?>" == "book") {
        column = [{
            "render": function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
            }
            },
            {
                "data": "name"
            },
            {
                "data": "isbnNumber"
            },
            {
                "data": "categories"
            },
            {
                "data": "authors"
            },
            {
                "data": "impression"
            }
        ];
    } else if ("<?php echo $list?>" == "user") {
        column = [{
            "render": function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
            }
            },
            {
                "data": "name"
            },
            {
                "data": "fullName"
            },
            {
                "data": "impression"
            }
        ];
    }
    $(document).ready(function() {
        url = "/<?php echo $list; ?>/<?php echo $sDate; ?>/<?php echo $eDate ?>"
        loadTableData("report-list", "/report/topList"+url, column);
    });
    document.getElementById('analytics').className += " active";
</script>