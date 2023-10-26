<?php
//moodleform is defined in formslib.php
require_once('../lib/formslib.php');

class simplehtml_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form.
        $mform->setType('email', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('email', 'Please enter email');        // Default value.

        // filepicker para subir archivos
        // al final, en el último array, se ponen los tipos de documentos permitidos para subida
        $mform->addElement('filepicker', 'test_file', get_string('file'), null, array('maxbytes' => 111111111111111, 'accepted_types' => array('.pdf', '.doc')));

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}