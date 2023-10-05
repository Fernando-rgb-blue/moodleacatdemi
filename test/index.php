<?php
//include simplehtml_form.php
require_once('../config.php');
global $CFG,$DB,$USER,$OUTPUT;
require_once($CFG->dirroot.'/test/form.php');

$redirect = $CFG->wwwroot.'/test/index.php';
echo $OUTPUT->header();
//Instantiate simplehtml_form 
$mform = new simplehtml_form();

//NEW-------------------------
/*
$idid = optional_param('id',0,PARAM_INT);
$entry = new stdClass;
$context = get_system_context();
if($idid<1){
  $entry->id = null;
}else{
  $entry = $db->get_record('email_list', array('id'=>$idid), '*', MUST_EXIST);
}*/
//NEW-------------------------

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    
    echo 'Tu cancelaste la solicitud';

} else if ($fromform = $mform->get_data()) {
  
    print_r($fromform);

    $data = new stdClass;
    $birth = new stdClass;
    //id
    //auth
    $data->confirmed = 1;
    //policyagreed
    //deleted
    //suspended
    $data->mnethostid = 1;
    $data->username = $fromform->username;
    $data->password = hash_internal_user_password($fromform->password);
    //idnumber
    $data->firstname = $fromform->firstname;
    $data->lastname = $fromform->lastname;
    $data->email = $fromform->email;

    $fecha = $fromform->birthdate;

    $data->birthdate = date('Y-m-d', $fecha);
    
    $birth->birthdate = date('Y-m-d', $fecha);
    //emailstop
    /*
    $data->phone1;
    $data->phone2;
    $data->institution;
    $data->department;
    $data->address;
    $data->city;
    $data->country;
    */
    //lang
    //calendartype
    //theme
    //timezone
    //fistaccess
    //lastlogin
    //currentlogin
    //lastip
    //secret
    //picture
    $data->maildisplay=1;
    
    //$data->email        =$fromform->email;
    //$data->added_time   =time();
    //$data->added_by     =$USER->id;
    /*
    $file = $mform->get_new_filename('daniel_file');
    $fullpath = 'upload/'.$file;
    $success = $mform->save_file('daniel_file', $fullpath);
    if(!$success){
      echo 'Uy, hubo un problema.';
    }
    
    $data->path=$fullpath;
    */
    //echo 'Nacimiento: ', $birth->birthdate; 
    //echo 'Tipo: ',gettype($birth->birthdate);
    //die;
    $DB->insert_record('user2',$data);
    //$DB->insert_record('birthdate2',$birth);
    
    redirect($redirect, 'Ha sido guardado con seguridad.', null, \core\output\notification::NOTIFY_SUCCESS);

} else {

  //Set default data (if any)
  $mform->set_data($toform);
  //displays the form
  $mform->display();
}

echo $OUTPUT->footer();