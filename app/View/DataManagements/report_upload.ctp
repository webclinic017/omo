<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link type="text/css" rel="stylesheet" href="../images/calender.css" media="screen"></link>
    <script type="text/javascript" src="../js/calendar.js"></script>

    <style>
        table td, table th{
            border:1px solid #CCCCCC;
        }
        input
        {
            border:1px solid #999999;
            margin:3px;
        }
    </style>
</head>

<body>

<?php echo $this->Session->flash('form1') ?>
<?php echo $this->Session->flash('form1_error') ?>
<?php echo $this->Session->flash('form2') ?>
<?php echo $this->Session->flash('form2_error') ?>
<form name="publish_form" id="publish_form" enctype="multipart/form-data" action="<?php echo Router::url('/', true)?>DataManagements/reportUpload" method="post">
    <table cellpadding="2" cellspacing="2">
        <tr>

            <th>
                Title
            </th>
            <th>
                Attachment
            </th>
            <th>
                Date
            </th>
        </tr>

        <tr>

            <th align="left">SB Daily Technical Report</th>
            <td><input type="file" name="doc_file1" size="70" /></td>
            <td>

                        <input id="depositDate" name="publishing_date1" class="form-control form-control-inline input-medium date-picker" type="text" value="<?php echo date('Y-m-d');?>">

            </td>
        </tr>
        <tr>

            <th align="left">SB Daily News Summary</th>
            <td><input type="file" name="doc_file2" size="70" /></td>
            <td>

                    <input id="depositDate" name="publishing_date2" class="form-control form-control-inline input-medium date-picker" type="text" value="<?php echo date('Y-m-d');?>">

            </td>
        </tr>

        <tr>
            <input type="hidden" name="upload_status" value="1">
            <td colspan="4" style="border:0 none;" align="right"> <button class="btn red btn-primary" type="reset" id='cancel' >Cancel<i class="glyphicon glyphicon-cancel"> </i></button>  <button class="btn green btn-primary" type="submit" id='Submit' >Upload<i class="glyphicon glyphicon-upload"> </i></button><!--<input type="submit" value="Publish"/>--></td>

        </tr>


    </table>
</form>
</body>

<script>

    $(function () {

        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            orientation: "left",
            //startDate:"+0d",
            format:"yyyy-mm-dd",
            //format:"unixtime",
            // dateFormat: "yy-mm-dd",
            // timeFormat:  "HH:mm:ss",
            daysOfWeekDisabled: '5,6',
            autoclose: true
        });

        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
    });
</script>
</html>