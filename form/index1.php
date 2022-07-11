<?php
global $PAGE;
require_once('../../config.php');
require_once('lib.php');
require_login();
$PAGE->requires->js_call_amd('local_form/main','init');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/form/index1.php');
$PAGE->set_title('my_form');
$PAGE->set_heading('my_form');

$renderer = $PAGE->get_renderer('local_form');
echo $OUTPUT->header();
echo $renderer->show_button();
$page = optional_param('page', 0, PARAM_INT); 
echo $renderer->show_data($page);
echo $OUTPUT->download_dataformat_selector(get_string('download_data', 'local_form'), 'download.php');
// echo $pagination = get_config('local_form','pagination');
echo $OUTPUT->footer();