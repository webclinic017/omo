<?php
function update_broker_fee($postdata, $primary, $xcrud)
{

    $db = Xcrud_db::get_instance();
    $query = 'UPDATE portfolios SET broker_fee=' . $postdata->get('broker_fee') . ' WHERE id = ' . $db->escape($primary);

    $db->query($query);
    $query = 'UPDATE portfolios SET broker=' . $postdata->get('broker_id') . ' WHERE id = ' . $db->escape($primary);
    $db->query($query);
}

function set_broker_fee($postdata, $xcrud)
{

    $db = Xcrud_db::get_instance();

    $pid = $postdata->get('portfolio_id');

    $sql = "SELECT *  FROM users WHERE portfolio_id = $pid";
    $db->query($sql);
    $result = $db->result();
    foreach ($result as $key => $item) {
        $broker_fee = $item['broker_fee'];
    }
    $postdata->set('commission', $broker_fee);
}

function adjust_purchase_power($postdata, $xcrud)
{
    $db = Xcrud_db::get_instance();

    $pid = $postdata->get('portfolio_id');
    $amount = $postdata->get('amount');
    $rate = $postdata->get('rate');
    $broker_fee = $postdata->get('commission');
    $transaction_type_id = $postdata->get('transaction_type_id');
    $transaction_time = $postdata->get('transaction_time');
    $updated = $postdata->get('updated');

    if ($transaction_type_id == 1) {
        $cost = $amount * $rate;
        $commision = $cost * ($broker_fee / 100);
        $adjusted_power = $cost + $commision;
        $adjusted_transaction_id = 12;


        $query = "INSERT INTO  `stocknet_omonew`.`portfolio_transactions` (

`portfolio_id` ,
`instrument_id` ,
`transaction_type_id` ,
`amount` ,
`rate` ,
`transaction_time` ,
`commission` ,
`parent_id` ,
`updated`
)
VALUES (
 '$pid', NULL ,  '$adjusted_transaction_id',  '1',  '$adjusted_power',  '$transaction_time', NULL ,  '0',  '$updated'
);";
        $db->query($query);
    }

    if ($transaction_type_id == 2) {
        $cost = $amount * $rate;
        $commision = $cost * ($broker_fee / 100);
        $adjusted_power = $cost - $commision;
        $adjusted_transaction_id = 13;


        $query = "INSERT INTO  `stocknet_omonew`.`portfolio_transactions` (

`portfolio_id` ,
`instrument_id` ,
`transaction_type_id` ,
`amount` ,
`rate` ,
`transaction_time` ,
`commission` ,
`parent_id` ,
`updated`
)
VALUES (
 '$pid', NULL ,  '$adjusted_transaction_id',  '1',  '$adjusted_power',  '$transaction_time', NULL ,  '0',  '$updated'
);";
        $db->query($query);
    }



}


function hash_password($postdata, $primary, $xcrud)
{
    $postdata->set('password', '5555');
}

function publish_action($xcrud)
{
    if ($xcrud->get('primary')) {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function unpublish_action($xcrud)
{
    if ($xcrud->get('primary')) {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload') {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function movetop($xcrud)
{
    if ($xcrud->get('primary') !== false) {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item) {
            if ($item['officeCode'] == $primary && $key != 0) {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item) {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}

function movebottom($xcrud)
{
    if ($xcrud->get('primary') !== false) {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item) {
            if ($item['officeCode'] == $primary && $key != $count - 1) {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item) {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}

function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1') {
        $result = '<i class="fa fa-check" />' . 'OK';
    } elseif ($value == '2') {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .
    '" />';
}

function unset_val($postdata)
{
    $postdata->del('Paid');
}

function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if (strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif (strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function before_list_example($list, $xcrud)
{
    var_dump($list);
}
function set_purchase_power($value, $fieldname, $priimary_key, $row, $xcrud)
{
    $db = Xcrud_db::get_instance();

    $sql = "SELECT *  FROM portfolio_transactions WHERE id = $priimary_key";
    $db->query($sql);
    $result = $db->result();
    $pid=$result[0]['portfolio_id'];

    $sql = "SELECT id,multiplier  FROM transaction_types";
    $db->query($sql);
    $result = $db->result();
    $ttypeArr=array();
    foreach ($result as $key => $item) {
        $tid=$item['id'];
        $multiplier=$item['multiplier'];
        $ttypeArr[$tid]=$multiplier;
    }

    $sql = "SELECT * FROM portfolio_transactions where portfolio_id=$pid ORDER BY  transaction_time ASC ";
    $db->query($sql);
    $result = $db->result();
    $transactionAmountArr2=array();
    foreach ($result as $key => $item) {
        $commission=0;
        if (isset($item['commission'])) {
            $commission=$item['commission'];
        }
        $amount=$item['amount'];
        $rate=$item['rate'];
        $transaction_type_id=$item['transaction_type_id'];

        $totalCommission = (($commission) / 100) * $amount * $rate;

        if ($transaction_type_id > 2) {
            $totalCommission = 0; // if it is not buy or sell transaction no commission will be applied
        }

        $transactionAmountArr2[]=($ttypeArr[$transaction_type_id] * $amount * $rate) - $totalCommission;

    }

    $balance = array_sum($transactionAmountArr2);
    return  $balance;
}

function update_purchase_power($postdata, $primary, $xcrud)
{

    $db = Xcrud_db::get_instance();

    $primary_key = $postdata->get('portfolio_transactions.id');
    $new_purchase_power = $postdata->get('portfolio_transactions.rate');


    $db = Xcrud_db::get_instance();

    $sql = "SELECT *  FROM portfolio_transactions WHERE id = $primary";
    $db->query($sql);
    $result = $db->result();
    $pid=$result[0]['portfolio_id'];
    $rate=$result[0]['rate'];

    $sql = "SELECT id,multiplier  FROM transaction_types";
    $db->query($sql);
    $result = $db->result();
    $ttypeArr=array();
    foreach ($result as $key => $item) {
        $tid=$item['id'];
        $multiplier=$item['multiplier'];
        $ttypeArr[$tid]=$multiplier;
    }

    $sql = "SELECT * FROM portfolio_transactions where portfolio_id=$pid ORDER BY  transaction_time ASC ";
    $db->query($sql);
    $result = $db->result();
    $transactionAmountArr2=array();
    foreach ($result as $key => $item) {
        $commission=0;
        if (isset($item['commission'])) {
            $commission=$item['commission'];
        }
        $amount=$item['amount'];
        $rate=$item['rate'];
        $transaction_type_id=$item['transaction_type_id'];

        $totalCommission = (($commission) / 100) * $amount * $rate;

        if ($transaction_type_id > 2) {
            $totalCommission = 0; // if it is not buy or sell transaction no commission will be applied
        }

        $transactionAmountArr2[]=($ttypeArr[$transaction_type_id] * $amount * $rate) - $totalCommission;

    }

    $old_purchase_power = array_sum($transactionAmountArr2);

    $adjustment_value=$new_purchase_power-$old_purchase_power;
    $rate=$rate+$adjustment_value;


    $postdata->set('rate', $rate);
}