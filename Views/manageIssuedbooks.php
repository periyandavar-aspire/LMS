<section>
    <div class="div-card">
        <div class="div-card-header">
            Categories
        </div>
        <div class="div-card-body"  style="overflow-x:auto;">
            <div>
                <div class="left-panel">
                    Record count
                    <select class="form-control left-panel-select">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                </div>
                <div class="right-panel">
                    Search <input type="text" class="form-control left-panel-input">
                </div>
            </div>
            <table class="tab_design">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book Name</th>
                        <th>ISBN </th>
                        <th>Issued Date</th>
                        <th>Return Date</th>
                        <th>Fine in(USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>PHP And MySql programming</td>
                        <td>222333</td>
                        <td>2017-07-15 16:29:26</td>
                        <td><span style="color:red">Not Return Yet</span></td>
                        <td></td>
                    </tr> 
                    <tr>
                        <td>1</td>
                        <td>PHP And MySql programming</td>
                        <td>222333</td>
                        <td>2017-07-15 16:29:26</td>
                        <td><span style="color:red">Not Return Yet</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>PHP And MySql programming</td>
                        <td>222333</td>
                        <td>2017-07-15 16:29:26</td>
                        <td><span style="color:red">Not Return Yet</span></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="panel">
                <div class="left-panel">
                    Showing 1 to 2 of 2 entries
                </div>
                <div class="right-panel">
                    <ul class="pagination">
                        <li class="disable"><a>Previous</a></li>
                        <li class="active"><a>1</a></li>
                        <li><a>2</a></li>
                        <li><a>3</a></li>
                        <li><a>Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('issued').className += " active";
</script>