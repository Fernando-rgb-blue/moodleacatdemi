<?php

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->libdir . '/pdflib.php');

class course_edit_form_2 extends moodleform {
    protected $course;
    protected $context;

    /**
     * Form definition.
     */
    function definition() {
        global $CFG, $PAGE;

        $mform    = $this->_form;
        $PAGE->requires->js_call_amd('core_course/formatchooser', 'init');

        $course        = !empty($this->_customdata['course']) ? $this->_customdata['course'] : null;
        $category      = !empty($this->_customdata['category']) ? $this->_customdata['category'] : null;
        $editoroptions = !empty($this->_customdata['editoroptions']) ? $this->_customdata['editoroptions'] : null;
        $returnto = !empty($this->_customdata['returnto']) ? $this->_customdata['returnto'] : null;
        $returnurl = !empty($this->_customdata['returnurl']) ? $this->_customdata['returnurl'] : null;

        $systemcontext   = context_system::instance();

        if (!empty($course->id)) {
            $coursecontext = context_course::instance($course->id);
            $context = $coursecontext;
        } else {
            $coursecontext = null;
            $context = $systemcontext; // Usar el contexto del sistema si no hay un curso.
        }

        $courseconfig = get_config('moodlecourse');

        $this->course  = $course;
        $this->context = $context;

        // Pregunta de visibilidad.
        $mform->addElement('header', 'visibilityhdr', get_string('visibility', 'core_question'));
        $mform->addElement('select', 'visibility', get_string('visibilityquestion', 'core_question'), array(
            0 => get_string('no'),
            1 => get_string('yes')
        ));
        $mform->setDefault('visibility', 0);
        $mform->setType('visibility', PARAM_INT);

        // Agregar un campo oculto para almacenar el ID del curso.
        $mform->addElement('hidden', 'courseid', $course->id);
        $mform->setType('courseid', PARAM_INT);

        // Resto del código...
    }

    /**
     * Validation.
     *
     * @param array $data
     * @param array $files
     * @return array the errors that were found
     */
    function validation_2($data, $files) {
        global $DB;
    

        $errors = parent::validation($data, $files);

        // Asegúrate de que 'visibility' está presente en los datos.
        if (isset($data['visibility'])) {
            // Obtener el valor del campo oculto.
            $courseid = $data['courseid']; // Ajusta según sea necesario.
            $visibilityvalue = $data['visibility'];

            // Guarda en mdl_visible.
            $visibledata = new stdClass();
            $visibledata->idcourses = $courseid;
            $visibledata->cvisibilidad = $visibilityvalue;
            $DB->insert_record('visible', $visibledata);
            $insertresult = $DB->insert_record('visible', $visibledata);
            if ($insertresult) {
                // Éxito
            } else {
                // Manejar error
                debugging("Error inserting data into mdl_visible table: " . $DB->get_last_error(), DEBUG_DEVELOPER);
            }

        }
        die('Validation function is running');
        return $errors;
        
    }
}
