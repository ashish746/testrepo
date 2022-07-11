<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_local_form_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion <  2020061500.01) {
        
        $table = new xmldb_table('myform');
        $field = new xmldb_field('attachments', XMLDB_TYPE_INTEGER, 10, null, XMLDB_NOTNULL, null, 0, 'qualification');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assignment savepoint reached.
        upgrade_plugin_savepoint(true,  2020061500.01,'local', 'form');
    }
    return true;
}