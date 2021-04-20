
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Users &nbsp;<a class="btn-link" onclick="openModal('addRecord');loadRoles();">New User</a></h1>
                    <hr>
                </div>
            </div>
            <div class="div-card-body">
                <div style="overflow-x:auto;">
                    <table class="tab_design" id='user-list'>
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>User Type</th>
                                <th>Registered At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-shadow" id="addRecord">
            <div class="modal">
                <span class="close-modal" onclick="closeModal('addRecord');">✖</span>
                <h1>Add New Book</h1>
                <hr><br>
                <form action="/admin/manageUsers" onsubmit="createUserFormValidator(event);" method="post">
                    <div class="form-input-div">
                        <label>Full Name</label>
                        <input class="form-control" type="text" id="fullname" name="fullName" autocomplete="off"
                            placeholder="Full Name" required="">
                    </div>
                    <div class="form-input-div">
                        <label>Email</label>
                        <input class="form-control" type="email" id="email" name="email" autocomplete="off"
                            placeholder="email" required="">
                    </div>

                    <div class="form-input-div">
                        <label>Role</label>
                        <select class="form-control" type="text" id="role" name="role" required="">
                            <option style="display:none" value=''>Select Role</option>
                        </select>
                    </div>

                    <div class="form-input-div">
                        <label>Password </label>
                        <input class="form-control" onkeyup="passStrength('password')" type="password" id="password"
                            name="password" placeholder="********" autocomplete="off">
                        <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none"
                            value="0"></meter>
                        <span id="pass1msg" style="display:none"></span>
                    </div>
                    <div class="form-input-div">
                        <label>Confirm Password </label>
                        <input class="form-control" onkeyup="checkConfirm('password','confirmPassword','errormsg')"
                            type="password" id="confirmPassword" name="confirmpassword" placeholder="********"
                            autocomplete="off">
                        <span id="errormsg" style="color:red"></span>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn-link">Add</button>
                    </div>
                </form>
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
            "data": "role"
        },
        {
            "data": "createdAt"
        },
        {
            "data": null,
            "render": function(item) {
                code = '<button type="button"';
                code += ' onclick="deleteItem(' + "'/user/delete/" + item.id + "');" + '"';
                code +=
                    'class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>';
                return code;
            }
        }
    ]
    $(document).ready(function() {
        loadTableData("user-list", "/allUser/loadData", column);
    });
</script>