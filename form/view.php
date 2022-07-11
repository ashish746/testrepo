<?php

require_once('../../config.php');
require_login();


$PAGE->set_url('/local/form/view.php');
$PAGE->set_title('view your pic');

$id = optional_param('id',0,PARAM_INT);
// echo $id;
$context = context_system::instance();
// echo $context->id;
$component = 'local_form';
$filearea = 'attachment';
$file_storage = get_file_storage();
$files = $file_storage->get_area_files($context->id,
$component,$filearea, $id);
foreach ($files as $file) {
    $filename = $file->get_filename();
    $url = moodle_url::make_pluginfile_url(
    $file->get_contextid(),
    $file->get_component(),
    $file->get_filearea(),
    $file->get_itemid(),
    $file->get_filepath(),
    $filename,
    false
    );
    }
    echo $OUTPUT->header();
    // echo $url;
     $outputImage = html_writer::img($url, '', array('width' => '250px',
    'height' => '250px'));
    // print_object($url);
    // die;
    echo $outputImage;

    echo $OUTPUT->footer();