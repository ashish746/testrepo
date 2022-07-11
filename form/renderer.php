<?php

defined('MOODLE_INTERNAL') || die();

class local_form_renderer extends plugin_renderer_base
{
    // To show the add user button.
    public function show_button()
    {
        $o = '';
        $url = new moodle_url('/local/form/mainform.php');
        $o .= html_writer::link($url, 'ADD USER');
        return $o;
    }

    public function show_data( $page)
    {
        global $DB,$CFG,$OUTPUT;
        $o = '';
        $s = 0;
        $totalcount = $DB->count_records('myform');
        if( $totalcount > 0){
            $table = new html_table();
            $table->head = array(
                get_string('srno.', 'local_form'),
                get_string('username', 'local_form'),
                get_string('email', 'local_form'),
                get_string('contact', 'local_form'),
                get_string('hobbies', 'local_form'),
                get_string('gender', 'local_form'),
                get_string('qualification', 'local_form'),
                get_string('action', 'local_form'),
                get_string('view', 'local_form'),
            );
        $baseurl = new moodle_url('/local/form/index1.php');
        $pagination  = get_config('local_form','pagination');

        if($pagination){
            $start = $page*$pagination;
            $perpage = $pagination;
            $sql = "select * from {myform} LIMIT $start,$perpage";
             $records = $DB->get_records_sql($sql); 
             $o .= $OUTPUT->paging_bar($totalcount, $page, $pagination, $baseurl);
        }else{
        $start = $page*PERPAGE;
        $perpage = PERPAGE;
        $sql = "select * from {myform} LIMIT $start,$perpage";
         $records = $DB->get_records_sql($sql); 
         $o .= $OUTPUT->paging_bar($totalcount, $page, PERPAGE, $baseurl);
        }
        foreach ($records as $data) {   
            $b = html_writer::tag('button','delete',array('ide' => $data->id,'class' => 'delete_btn')) . " ";
            $url1 = new moodle_url('/local/form/mainform.php', array('id' => $data->id));
            $b .= html_writer::link($url1, 'edit');
            $url2 = new moodle_url('/local/form/view.php', array('id' => $data->id));
            $d = html_writer::link($url2, 'view');
            $s++;
            $table->data[] = array(
                $s,
                $data->username,
                $data->email,
                $data->contact,
                $data->hobbies,
                $data->gender,
                $data->qualification,
                $b,
                $d,
            );
       };
       
       $o .= html_writer::table($table);
    }else{
        $o .= html_writer::div('no record','',array());
    }
    return $o;
    }
}
