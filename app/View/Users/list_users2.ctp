<button id="btnAddNewRow">Add</button>
<button id="btnDeleteRow">Delete</button>
<table id="myDataTable">
    <thead>
    <tr>
        <th>Company name</th>
        <th>Address</th>
        <th>Town</th>
    </tr>
    </thead>
    <tbody>
    <tr id="17">
        <td>Emkay Entertainments</td>
        <td>Nobel House, Regent Centre</td>
        <td>Lothian</td>
    </tr>
    <tr id="18">
        <td>The Empire</td>
        <td>Milton Keynes Leisure Plaza</td>
        <td>Buckinghamshire</td>
    </tr>
    <tr id="19">
        <td>Asadul Ltd</td>
        <td>Hophouse</td>
        <td>Essex</td>
    </tr>
    <tr id="21">
        <td>Ashley Mark Publishing Company</td>
        <td>1-2 Vance Court</td>
        <td>Tyne &amp; Wear</td>
    </tr>
    </tbody>
</table>
<form id="formAddNewRow" action="#">
    <label for="name">Name</label><input type="text" name="name" id="name" class="required" rel="0" />
    <br />
    <label for="name">Address</label><input type="text" name="address" id="address" rel="1" />
    <br />
    <label for="name">Postcode</label><input type="text" name="postcode" id="postcode"/>
    <br />
    <label for="name">Town</label><input type="text" name="town" id="town" rel="2" />
    <br />
    <label for="name">Country</label><select name="country" id="country">
    <option value="1">Serbia</option>
    <option value="2">France</option>
    <option value="3">Italy</option>
</select>
    <br />
</form>
<?php $this->start('script_inside_doc_ready'); ?>
$('#myDataTable').dataTable().makeEditable({
sUpdateURL: "/Home/UpdateData.php"
});

<?php $this->end(); ?>


