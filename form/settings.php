<?php
defined('MOODLE_INTERNAL') || die();
require_once('lib.php');

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_category('local_form_settings', new lang_string('pluginname', 'local_form')));
    $settingspage = new admin_settingpage('managelocalform', new lang_string('manage', 'local_form'));

    if ($ADMIN->fulltree) {
        $settingspage->add(new admin_setting_configtext(
            'local_form/pagination',
            new lang_string('pagination', 'local_form'),
            new lang_string('pagination', 'local_form'),
            'PERPAGE',
            PARAM_INT
        ));
    }

    $ADMIN->add('localplugins', $settingspage);
}