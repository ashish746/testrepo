<?php
require_once('../../config.php');
require_login();

global $DB;
$ide = optional_param('id','', PARAM_INT);
$demodata = $DB->delete_records('myform',array('id'=>$ide));
$url = new moodle_url("/local/form/index1.php");
redirect($url,'you data has been deleted');