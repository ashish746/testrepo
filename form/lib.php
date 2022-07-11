<?php
defined('MOODLE_INTERNAL') || die();

define('PERPAGE',5);

// To get the data in the table.
function show_table(){
    global $DB;
    $show = $DB->get_records('myform', array());
    return $show;
}

// To fetch the data of user from the database.
function fetch_data($userid){
    global $DB;
    $data = $DB->get_record('myform',array('id' => $userid));
    return $data;
}

function local_form_pluginfile($course, $cm, $context, $filearea, $args,
$forcedownload, array $option = array())
{
    global $CFG;

    $itemid = array_shift($args);
    $filename = array_pop($args);

    if (!$args) {
        $filepath = '/';
        } else {
        $filepath = '/' . implode('/', $args) . '/';
        }
        $file_storage = get_file_storage();
        $file = $file_storage->get_file($context->id, 'local_form', 'attachment',
        $itemid, $filepath, $filename);
        if (!$file) {
            //send_file_not_found();
            return false;
            } else {
            send_stored_file($file, null, 0, $forcedownload, $option);
            }
}