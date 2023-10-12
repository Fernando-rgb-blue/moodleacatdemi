<?php

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->libdir . '/pdflib.php');

/**
 * The form for handling editing a course.
 */
class course_edit_form extends moodleform {
    protected $course;
    protected $context;

    /**
     * Form definition.
     */
    function definition() {
        global $CFG, $PAGE;
    
        $mform = $this->_form;
    
        $course = $this->_customdata['course'];
        $category = $this->_customdata['category'];
        $editoroptions = $this->_customdata['editoroptions'];
    
        // Form definition with the desired course fields.
        $mform->addElement('header', 'general', get_string('general', 'form'));
    
        $mform->addElement('text', 'fullname', get_string('fullnamecourse'), 'maxlength="254" size="50"');
        $mform->addHelpButton('fullname', 'fullnamecourse');
        $mform->addRule('fullname', get_string('missingfullname'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_TEXT);
    
        $mform->addElement('text', 'shortname', get_string('shortnamecourse'), 'maxlength="100" size="20"');
        $mform->addHelpButton('shortname', 'shortnamecourse');
        $mform->addRule('shortname', get_string('missingshortname'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_TEXT);
    
        $mform->addElement('select', 'category', get_string('coursecategory'), core_course_category::make_categories_list('moodle/course:create'));
        $mform->addRule('category', null, 'required', null, 'client');
        $mform->addHelpButton('category', 'coursecategory');
    
        $mform->addElement('date_time_selector', 'startdate', get_string('startdate'));
        $mform->addHelpButton('startdate', 'startdate');
    
        $mform->addElement('date_time_selector', 'enddate', get_string('enddate'), array('optional' => true));
        $mform->addHelpButton('enddate', 'enddate');
    
        $mform->addElement('editor', 'summary_editor', get_string('coursesummary'), null, $editoroptions);
        $mform->addHelpButton('summary_editor', 'coursesummary');
        $mform->setType('summary_editor', PARAM_RAW);
    
        // Handle the maximum upload size.
        $choices = get_max_upload_sizes($CFG->maxbytes, 0, 0, $course->maxbytes);
        $mform->addElement('select', 'maxbytes', get_string('maximumupload'), $choices);
        $mform->addHelpButton('maxbytes', 'maximumupload');
    
        // Check if the course ID is valid before calling instance_form_definition.
        if ($course && isset($course->id) && is_int($course->id)) {
            // Add custom fields to the form.
            $handler = core_course\customfield\course_handler::create();
            $handler->instance_form_definition($mform, $course->id);
        }
    
        // Remove the existing buttons.
        $mform->removeElement('save');
        $mform->removeElement('cancel');
    
        // Add the "Guardar cambios y mostrar" button.
        $buttonarray = array();
        $classarray = array('class' => 'form-submit');
        $buttonarray[] = &$mform->createElement('submit', 'saveanddisplay', get_string('savechangesanddisplay'), $classarray);
        $buttonarray[] = &$mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');
    
        // Set the current form data
        $this->set_data($course);
    }
    
    
    /**
     * Fill in the current page data for this course.
     */
    function definition_after_data() {
        global $DB;
    
        $mform = $this->_form;
    
        // add available groupings
        $courseid = $mform->getElementValue('id');
        if ($courseid && $mform->elementExists('defaultgroupingid')) {
            $options = array();
            if ($groupings = $DB->get_records('groupings', array('courseid' => $courseid))) {
                foreach ($groupings as $grouping) {
                    $options[$grouping->id] = format_string($grouping->name);
                }
            }
            core_collator::asort($options);
            $gr_el = $mform->getElement('defaultgroupingid');
            $gr_el->load($options);
        }
    
        // add course format options
        $formatvalue = $mform->getElementValue('format');
        if (is_array($formatvalue) && !empty($formatvalue)) {
            $params = array('format' => $formatvalue[0]);
            if ($courseid && is_int($courseid)) { // Verify that courseid is an integer
                $params['id'] = $courseid;
            }
            $courseformat = course_get_format((object)$params);
    
            $elements = $courseformat->create_edit_form_elements($mform);
            // Create an array to hold the names of fields you want to keep
            $fieldsToKeep = array('fullname', 'shortname', 'category', 'startdate', 'enddate', 'summary_editor', 'maxbytes');
            for ($i = 0; $i < count($elements); $i++) {
                // Check if the element name is in the array of fields to keep
                if (in_array($elements[$i]->getName(), $fieldsToKeep)) {
                    $mform->insertElementBefore($mform->removeElement($elements[$i]->getName(), false), 'addcourseformatoptionshere');
                } else {
                    // Remove any other elements
                    $mform->removeElement($elements[$i]->getName(), false);
                }
            }
            // Remove newsitems element if format does not support news.
            if (!$courseformat->supports_news()) {
                $mform->removeElement('newsitems');
            }
        }
    
        // Tweak the form with values provided by custom fields in use.
        $handler = core_course\customfield\course_handler::create();
        // Verificar que el courseid sea un entero válido antes de llamar a instance_form_definition_after_data
        if (is_int($courseid)) {
            $handler->instance_form_definition_after_data($mform, $courseid);
        }
    }
    
    
    /**
     * Validation.
     *
     * @param array $data
     * @param array $files
     * @return array the errors that were found
     */
    function validation($data, $files) {
        global $DB;
    
        $errors = parent::validation($data, $files);
    
        // Add field validation check for duplicate shortname.
        if ($course = $DB->get_record('course', array('shortname' => $data['shortname']), '*', IGNORE_MULTIPLE)) {
            if (empty($data['id']) || $course->id != $data['id']) {
                $errors['shortname'] = get_string('shortnametaken', '', $course->fullname);
            }
        }
    
        // Add field validation check for duplicate idnumber.
        if (!empty($data['idnumber']) && (empty($data['id']) || $this->course->idnumber != $data['idnumber'])) {
            if ($course = $DB->get_record('course', array('idnumber' => $data['idnumber']), '*', IGNORE_MULTIPLE)) {
                if (empty($data['id']) || $course->id != $data['id']) {
                    $errors['idnumber'] = get_string('courseidnumbertaken', 'error', $course->fullname);
                }
            }
        }
    
        if ($errorcode = course_validate_dates($data)) {
            $errors['enddate'] = get_string($errorcode, 'error');
        }
    
        $errors = array_merge($errors, enrol_course_edit_validation($data, $this->context));
    
        $courseformat = course_get_format((object)array('format' => $data['format']));
        $formaterrors = $courseformat->edit_form_validation($data, $files, $errors);
        if (!empty($formaterrors) && is_array($formaterrors)) {
            $errors = array_merge($errors, $formaterrors);
        }
    
        // Add the custom fields validation.
        $handler = core_course\customfield\course_handler::create();
        $courseid = $data['id'];
        if (!empty($courseid) && is_int($courseid)) {
            $errors = array_merge($errors, $handler->instance_form_validation($data, $files, $courseid));
        }
        
       return $errors;
    }
}
