<?php
defined('VALID_REQ') or exit('Invalid request');
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Categories &nbsp;<a class="btn-link" onclick="openModal('addRecord');">Add</a></h1>
                    <hr>
                </div>
            </div>
            <div class="div-card-body">
                <div style="overflow-x:auto;">
                    <table id="category-list" class="tab_design">
                        <thead>
                            <tr>
                                <th data-orderable="false">Sl. No</th>
                                <th>Category</th>
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
        <div class="modal-shadow" id="addRecord">
            <div class="modal">
                <span class="close-modal" onclick="closeModal('addRecord');">✖</span>
                <h1>Add New Category</h1>
                <hr><br>
                <form onsubmit="categoryValidator(event, this);" action="/categories" id="add" method="post">
                    <div class="form-input-div">
                        <label>Category Name</label>
                        <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="catname" name="name"
                            autocomplete="off" placeholder="Category Name..." required="">
                    </div>
                    <div class="form-buttons">
                        <button type="submit" name="action" value="add" class="btn-link">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-shadow" id="editRecord">
            <div class="modal">
                <span class="close-modal" onclick="closeModal('editRecord');">✖</span>
                <h1>Edit Category</h1>
                <hr><br>
                <form onsubmit="categoryValidator(event, this);" action="/categories" id="edit" onsubmit="updateItem(event);" method="post">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="form-input-div">
                        <label>Category Name</label>
                        <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="edit-name" name="name"
                            autocomplete="off" placeholder="Category Name..." required="">
                    </div>
                    <div class="form-buttons">
                        <button type="submit" name="action" value="update" class="btn-link">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</article>

<script>
    document.getElementById('categories').className += " active";
    column = [{
        "render": function (data, type, row, meta) {
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
                code += "'/categories/changeStatus/" + item.id + "');" + '" ';
                code += item.status == 1 ? "checked" : '';
                code += '></div>';
                return code;
            }
        },
        {
            "data": null,
            "render": function(item) {
                code = '<button type="button" onclick="editItem(';
                code += "'/categories/edit/" + item.id + "');" + '"';
                code +=
                    'class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></button> <button type="button"';
                code += ' onclick="deleteItem(' + "'/categories/delete/" + item.id + "');" + '"';
                code +=
                    'class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>';
                return code;
            }
        }
    ]
    $(document).ready(function() {
        loadTableData("category-list", "/category/loadData", column);
    });
</script>