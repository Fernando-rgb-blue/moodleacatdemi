<?php
//include simplehtml_form.php
require_once('../config.php');
global $CFG, $DB, $USER, $OUTPUT;
require_once($CFG->dirroot.'/uploadfiles/form.php');

$redirect = $CFG->wwwroot.'/uploadfiles/index.php';

echo $OUTPUT->header();
//Instantiate simplehtml_form 
$mform = new simplehtml_form();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
  echo "Has presionado el botón de cancelar.";
} else if ($fromform = $mform->get_data()) {
  //print_r($fromform);

  // guardar email
  $data = new stdClass;
  $data->email = $fromform->email;
  $data->added_time = time();
  $data->added_by = $USER->id;

  // guardar archivo, el nombre no importa, pero en caso de cambiarlo, arreglar todas sus instancias
  $file = $mform->get_new_filename('test_file');
  //$file = $mform->get_new_filename('test_file');
  // aquí se coloca la dirección a subir el archivo
  $fullpath = "uploads/".$file;
  $success = $mform->save_file('test_file', $fullpath, true);
  //echo $fullpath; die;

  if(!$success){
    echo 'Algo salió mal en la subida de archivos. Intente de nuevo.';
  }

  $data->file_path = $fullpath; // Por alguna razón, esto no funciona.

  // Aquí se pone la tabla para guardar en la base de datos, sin el "mdl_" al inicio
  $DB->insert_record('email_list', $data);
  redirect($redirect, 'Se ha añadido correctamente.', null, \core\output\notification::NOTIFY_SUCCESS);
  
} else {
  //Set default data (if any)
  $mform->set_data($toform);
  //displays the form
  $mform->display();
}

echo $OUTPUT->footer();