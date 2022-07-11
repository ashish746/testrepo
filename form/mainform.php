<?php
require_once('../../config.php');
require_once('lib.php');
require_once('index.php');
global $DB, $PAGE;
require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/form/mainform.php');
$PAGE->set_title('my_form');
$PAGE->set_heading('my_form');

$context = context_system::instance();
$contextid = $context->id;

$id = optional_param('id', null, PARAM_INT);
$mform = new simplehtml_form('', array('userid' => $id));
$toform = fetch_data($id);

if ($toform) {
  $hobbies = $toform->hobbies;
  $hobb = explode(',', $hobbies);
  if (in_array('cricket', $hobb)) {
    $toform->hobb['cricket'] = 1;
  }
  if (in_array('swimming', $hobb)) {
    $toform->hobb['swimming'] = 1;
  }
  if (in_array('cycling', $hobb)) {
    $toform->hobb['cycling'] = 1;
  }
}

if ($mform->is_cancelled()) {
  $url = new moodle_url('/local/form/mainform.php');
  redirect($url);
} else if ($fromform = $mform->get_data()) {
  if (!empty($fromform->hobb)) {
    $hobby = array_keys($fromform->hobb);
    $fromform->hobbies = implode(',', $hobby);
  }
  $url = new moodle_url('/local/form/index1.php');
  if ($DB->record_exists('myform', array('id' => $id))) {
    $update_record = $DB->update_record('myform', $fromform);
    if ($update_record) {
      redirect($url);
    } else {
    }
  } else {
    $insert_record = $DB->insert_record('myform', $fromform, true);

    $draftitemid = file_get_submitted_draft_itemid('attachements');

    file_save_draft_area_files(
      $draftitemid,
      $contextid,
      'local_form',
      'attachment',
      $insert_record,
      array('subdirs' => 0, 'maxbytes' => 1024, 'maxfiles' => 50)
    );
    if ($insert_record) {
      redirect($url);
    } else {
    }
  }
} else {
  echo $OUTPUT->header();
  $mform->set_data($toform);
  $mform->display();
  echo $OUTPUT->footer();
}
