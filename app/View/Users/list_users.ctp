<a class="btn default" data-toggle="modal" href="#basic" id="btnAddNewRow">  Add </a>
<!--<button type="button" class="btn blue" id="btnAddNewRow">Add</button>-->
<button type="button" class="btn default" id="btnDeleteRow">Delete</button>
<table class="table table-striped table-hover table-bordered" id="users-table">
    <thead>
    <th>Username</th>
    <th>Middle name</th>
    <th>Email</th>
    <th>Created</th>
    </thead>
    <tbody>
    </tbody>
</table>
<form role="form" id="formAddNewRow">
    <div class="well">
        <div class="form-group">
            <label>Username</label>
            <div class="input-icon">
                <i class="fa fa-bell-o"></i>
                <input type="text" class="form-control" name="username" id="username" class="required" rel="0">
            </div>
        </div>
        <div class="form-group">
            <label>Username</label>
            <div class="input-icon">
                <i class="fa fa-bell-o"></i>
                <input type="text" class="form-control" name="middle_name" id="middle_name" class="required" rel="1">
            </div>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
                <input type="text" class="form-control" placeholder="Email Address" name="email" id="email" class="required" rel="2">
            </div>
        </div>
        <div class="form-group">
            <label>created</label>
            <div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
                <input type="text" class="form-control"  name="created" id="created" class="required" rel="3">
            </div>
        </div>


    </div>
    <div class="form-actions">
        <button type="submit" id="btnAddNewRowOk" class="btn blue">Submit</button>
        <button type="button" id="btnAddNewRowCancel" class="btn default">Cancel</button>
    </div>

</form>


<!--<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="formAddNewRow">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-icon">
                                <i class="fa fa-bell-o"></i>
                                <input type="text" class="form-control" name="username" id="username" class="required" rel="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-icon">
                                <i class="fa fa-bell-o"></i>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" class="required" rel="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
                                <input type="text" class="form-control" placeholder="Email Address" name="email" id="email" class="required" rel="2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>created</label>
                            <div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
                                <input type="text" class="form-control"  name="created" id="created" class="required" rel="3">
                            </div>
                        </div>


                    </div>
                    <div class="form-actions">
                        <button type="submit" id="btnAddNewRowOk" class="btn blue">Submit</button>
                        <button type="button" id="btnAddNewRowCancel" class="btn default">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        &lt;!&ndash; /.modal-content &ndash;&gt;
    </div>
    &lt;!&ndash; /.modal-dialog &ndash;&gt;
</div>-->

<?php $this->start('script_inside_doc_ready'); ?>
$('#users-table').dataTable({
"bProcessing": true,
"bServerSide": true,
"sAjaxSource": "<?php echo Router::url(array('controller'=>'users','action'=>'list_users.json'));?>",
"aoColumns": [
{mData:"User.username"},
{mData:"User.middle_name"},
{mData:"User.email"},
{mData:"User.created"}
],
});

$('#users-table').dataTable().makeEditable({
sUpdateURL: "/Home/UpdateData.php",
sAddURL: "/Home/AddData.php"
});

<?php $this->end(); ?>


