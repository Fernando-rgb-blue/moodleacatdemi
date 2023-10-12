<?php
//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform
{
    //Add elements to form
    public function definition()
    {
        global $CFG;
        //global $maxbytes = 11111111111111;
        $mform = $this->_form; // Don't forget the underscore! 
        
        $condition = array('maxlength' => 20, 'minlength' => 4);
        
        $mform->addElement('text', 'username', 'Nombre de usuario', $condition); // Add elements to your form.
        $mform->setType('username', PARAM_NOTAGS); // Set type of element.
        $mform->addRule('username', 'Se requiere ingresar un nombre de usuario', 'required', null, 'client');

        $mform->addElement('text', 'firstname', 'Nombre'); // Add elements to your form.
        $mform->setType('firstname', PARAM_NOTAGS); // Set type of element.
        $mform->addRule('firstname', 'Se requiere ingresar un nombre', 'required', null, 'client');

        $mform->addElement('text', 'lastname', 'Apellido'); // Add elements to your form.
        $mform->setType('lastname', PARAM_NOTAGS); // Set type of element.
        $mform->addRule('lastname', 'Se requiere ingresar un apellido', 'required', null, 'client');
        
        $mform->addElement('text', 'email', 'Correo'); // Add elements to your form.
        $mform->setType('email', PARAM_NOTAGS); // Set type of element.
        $mform->addRule('email', 'Se requiere ingresar un correo.', 'required', null, 'client');
        
        $mform->addElement('passwordunmask', 'password', 'Contraseña', $attributes);
        $mform->setType('password', PARAM_NOTAGS); // Set type of element.
        $mform->addRule('password', 'Se requiere ingresar una contraseña.', 'required', null, 'server');

        $mform->addElement('date_selector', 'birthdate', 'Fecha');
        $mform->setType('birthdate', PARAM_NOTAGS); // Set type of element.
        $mform->addRule('birthdate', 'Se requiere ingresar una contraseña.', 'required', null, 'server');

        
        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files)
    {
        return array();
    }
}