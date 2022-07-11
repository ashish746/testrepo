<?php

global $CFG;
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform
{
    //Add elements to form
    public function definition()
    {

        $myform = $this->_form; // Don't forget the underscore! 
        $id =  $this->_customdata['userid'];

        $myform->addElement('hidden', 'id', $id);
        $myform->setType('id', PARAM_INT);

        $myform->addElement('text', 'username', get_string('username', 'local_form'));
        $myform->addRule('username', null, 'required', null, 'client');
        $myform->setType('username', PARAM_NOTAGS);

        $myform->addElement('text', 'email', get_string('email', 'local_form'),'maxlength="20" size="20"');
        $myform->addRule('email', 'you must fill this value', 'required', null, 'client');
        $myform->setType('email', PARAM_NOTAGS);

        $myform->addElement('text', 'contact', get_string('number', 'local_form'),'maxlength="10" size="20"');
        $myform->addRule('contact', null, 'required', null, 'client');
        $myform->addRule('contact', null, 'numeric', null, 'client');
        $myform->setType('contact', PARAM_NOTAGS);
        
        $myform->addElement('static', 'description', get_string('hobbies', 'local_form'));
        $myform->addElement('checkbox', 'hobb[cricket]', get_string('cricket', 'local_form'));
        $myform->addElement('checkbox', 'hobb[swimming]', get_string('swimming', 'local_form'));
        $myform->addElement('checkbox', 'hobb[cycling]', get_string('cycling', 'local_form'));

        $myform->addElement('static', 'description', get_string('gender', 'local_form'));
        $radioarray = array();
        $radioarray[] = $myform->createElement('radio', 'gender', '', get_string('male','local_form'),get_string('male','local_form'));
        $radioarray[] = $myform->createElement('radio', 'gender', '', get_string('female','local_form'),get_string('female','local_form'));
        $myform->addGroup($radioarray, 'radioar', '', array(' '), false);

        $options = array(
            'btech' => 'btech',
            'bca' => 'bca',
            'bsc' => 'bsc'
        );
        $select = $myform->addElement('select', 'qualification', get_string('qualification','local_form'), $options);
        $myform->addRule('qualification', null, 'required', null, 'client');
        $select->setSelected('btech');

        $myform->addElement('filemanager', 'attachements', get_string('file_upload', 'local_form'), null,
                    array('subdirs' => 0, 'maxbytes' => 1024, 'areamaxbytes' => 10485760, 'maxfiles' => 50,
                          ));


        $this->add_action_buttons($cancel = true, $submitlabel = get_string('submit', 'local_form'));
        $buttonarray[] = $myform->createElement('reset', 'resetbutton', get_string('reset','local_form'));
        $myform->addGroup($buttonarray, 'buttonar', '', ' ', false);
    }
}
