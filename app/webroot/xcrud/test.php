<?php
include('xcrud.php');
$xcrud = Xcrud::get_instance();
$xcrud->table('users');
echo $xcrud->render();