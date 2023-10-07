<?php
//include simplehtml_form.php
require_once('../config.php');
global $CFG,$DB,$USER,$OUTPUT;
require_once($CFG->dirroot.'/test/form.php');

$redirect = $CFG->wwwroot.'/test/index.php';
echo $OUTPUT->header();
//Instantiate simplehtml_form 
$mform = new simplehtml_form();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    
    echo 'Tu cancelaste la solicitud';

} else if ($fromform = $mform->get_data()) {
  
    //print_r($fromform);

    $data = new stdClass;
    $date = new stdClass;

    $data->confirmed = 1;
    $data->mnethostid = 1;
    $data->username = $fromform->username;
    $data->password = hash_internal_user_password($fromform->password);
    $data->firstname = $fromform->firstname;
    $data->lastname = $fromform->lastname;
    $data->email = $fromform->email;
    $data->maildisplay=1;
    $fecha = $fromform->birthdate;

    $existing_username = $DB->get_record('user', array('username' => $data->username));
    $existing_email = $DB->get_record('user', array('email' => $data->email));
    if ($existing_username && $existing_email) {
      // Si el nombre de usuario y correo existe, muestra un mensaje
      redirect($redirect, 'El nombre de usuario y contraseña ya ha sido registrado, usar otro nombre y contraseña.',
      null, \core\notification::error('Problemas'));
    }
    if ($existing_username) {
      // Si el nombre de usuario existe, muestra un mensaje
      redirect($redirect, 'El nombre de usuario ya ha sido registrado, usar otro nombre.',
      null, \core\notification::error('Problemas'));
    }
    if ($existing_email) {
      // Si el correo existe, muestra un mensaje
      redirect($redirect, 'El correo ya ha sido registrado, usar otro correo.',
      null, \core\notification::error('Problemas'));
    }
    
    $new_user_id = $DB->insert_record('user',$data);

    $date->userid = $new_user_id;
    $date->birthdate = date('Y-m-d', $fecha);
    echo 'El dato se va a guardar';
    die;
    $DB->insert_record('dates',$date);
    
    
    redirect($redirect, 'Ha sido guardado con seguridad.', null, \core\output\notification::NOTIFY_SUCCESS);

} else {

  //Set default data (if any)
  $mform->set_data($toform);
  //displays the form
  $mform->display();
}

echo $OUTPUT->footer();