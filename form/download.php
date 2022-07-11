<?php
require_once('../../config.php');
$dataformat = optional_param('dataformat', '', PARAM_ALPHA);
$columns = array(
    'srno.' => get_string('srno.','local_form'),    
    'username' => get_string('username','local_form'),
    'email' => get_string('email','local_form'),
    'contact' => get_string('contact','local_form'),
    'hobbies' => get_string('hobbies','local_form'),
);
$sql = "select id,username,email,contact,hobbies from {myform}";
$rs = $DB->get_recordset_sql($sql);
$filename = 'myfile';

\core\dataformat::download_data($filename, $dataformat, $columns,$rs,null);