<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * The main mod_iconactivatecontent configuration form.
 *
 * @package     mod_iconactivatecontent
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <pascal.collins@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form.
 *
 * @package     mod_iconactivatecontent
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <pascal.collins@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_iconactivatecontent_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {
        global $CFG, $OUTPUT, $PAGE;
        $PAGE->requires->js_call_amd('mod_iconactivatecontent/switchtemplate', 'init');
        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are shown.
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('textarea', 'intro', get_string('externalcontent', 'mod_iconactivatecontent'), 'rows="10" cols="50"');
        $mform->addRule('intro', null, 'required', null, 'client');
        $mform->setType('intro', PARAM_RAW);
        $mform->addHelpButton('intro', 'externalcontent', 'mod_iconactivatecontent');

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('name', 'mod_iconactivatecontent'), array('size' => '64'));
        $mform->addElement('text', 'headline', get_string('labelheadline', 'mod_iconactivatecontent'), array('size' => 64));
        $config = get_config('iconactivatecontent');
        $mform->setDefault('headline', get_string('defaultheadline', 'mod_iconactivatecontent'));
        $mform->addElement('textarea', 'body', get_string('labeltext', 'mod_iconactivatecontent'), 'rows="10" cols="50"');
        $mform->setType('body', PARAM_RAW);
        $mform->setDefault('body', get_string('defaulttext', 'mod_iconactivatecontent'));
        $mform->addElement('text', 'footer', get_string('labelfooter', 'mod_iconactivatecontent'), array('size' => 64));
        $mform->setDefault('footer', get_string('defaultfooter', 'mod_iconactivatecontent'));

        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'iconactivatecontentname', 'mod_iconactivatecontent');
        $platformoptions = array(
            'none' => get_string('none', 'mod_iconactivatecontent'),
            'Twitter' => 'Twitter',
            'YouTube' => 'YouTube',
            'Facebook' => 'Facebook',
            'Google Maps' => 'Google Maps',
            'Instagram' => 'Instagram',
            'custom' => get_string('custom', 'mod_iconactivatecontent')
        );
        $mform->addElement('select', 'icon', get_string('labelicon', 'mod_iconactivatecontent'), $platformoptions);

        $mform->addElement(
            'filemanager',
            'customicon',
            get_string('customicon', 'mod_iconactivatecontent'),
            array(
                'subdirs' => 0,
                'maxfiles' => 1,
                'accepted_types' => 'web_image'
                )
        );
        $mform->hideIf('customicon', 'icon', 'neq', 'custom');

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }

    /**
     * @param $defaultvalues
     *
     * @return void
     */
    public function data_preprocessing(&$defaultvalues) {
        $draftitemid = file_get_submitted_draft_itemid('customicon');
        file_prepare_draft_area(
            $draftitemid,
            $this->context->id,
            'mod_iconactivatecontent',
            'customiconfilearea',
            0,
            array(
                'subdirs' => 0,
                'maxfiles' => 1,
                'accepted_types' => 'web_image'
            )
        );
        $defaultvalues['customicon'] = $draftitemid;
    }
}

