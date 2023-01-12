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
 * Library of interface functions and constants.
 *
 * @package     mod_iconactivatecontent
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <pascal.collins@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once(__DIR__ . "/locallib.php");

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null | int True if the feature is supported, null otherwise.
 */
function iconactivatecontent_supports($feature) {
    switch ($feature) {
        case FEATURE_IDNUMBER:
            return true;
        case FEATURE_GROUPS:
            return false;
        case FEATURE_GROUPINGS:
            return false;
        case FEATURE_MOD_INTRO:
            return false;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return false;
        case FEATURE_GRADE_HAS_GRADE:
            return false;
        case FEATURE_GRADE_OUTCOMES:
            return false;
        case FEATURE_MOD_ARCHETYPE:
            return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        case FEATURE_NO_VIEW_LINK:
            return true;
        case FEATURE_MOD_PURPOSE:
            return MOD_PURPOSE_CONTENT;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_iconactivatecontent into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_iconactivatecontent_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function iconactivatecontent_add_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timecreated = time();

    $moduleinstance->id = $id = $DB->insert_record('iconactivatecontent', $moduleinstance);
    iconactivatecontent_save_customicon($moduleinstance, $mform);

    return $id;
}

/**
 * Updates an instance of the mod_iconactivatecontent in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_iconactivatecontent_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function iconactivatecontent_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;
    iconactivatecontent_save_customicon($moduleinstance, $mform);
    return $DB->update_record('iconactivatecontent', $moduleinstance);
}

/**
 * Removes an instance of the mod_iconactivatecontent from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function iconactivatecontent_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('iconactivatecontent', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('iconactivatecontent', array('id' => $id));

    return true;
}

/**
 * Given a course_module object, this function returns any
 * "extra" information that may be needed when printing
 * this activity in a course listing.
 * See get_array_of_activities() in course/lib.php
 *
 * @param object $coursemodule
 * @return cached_cm_info|null
 * @global object
 */
function iconactivatecontent_get_coursemodule_info($coursemodule) {
    global $DB, $OUTPUT, $PAGE, $CFG;

    $PAGE->requires->js_call_amd('mod_iconactivatecontent/activate', 'init');
    if ($iconactivatecontent = $DB->get_record('iconactivatecontent', array('id' => $coursemodule->instance), '*')) {
        if (empty($iconactivatecontent->name)) {
            $iconactivatecontent->name = "iconactivatecontent{$iconactivatecontent->id}";
            $DB->set_field('iconactivatecontent', 'name', $iconactivatecontent->name, array('id' => $iconactivatecontent->id));
        }
        $course = new stdClass();
        $course->id = $coursemodule->course;
        $info = new cached_cm_info();

        $iconactivatecontent->id = "externalcontent_id" . $iconactivatecontent->id;
        $iconactivatecontent->template = format_module_intro('iconactivatecontent', $iconactivatecontent, $coursemodule->id, false);
        $iconactivatecontent->externalcontent = get_string('externalcontent', 'mod_iconactivatecontent');
        $hasstandardicon = $iconactivatecontent->icon !== "none"
            && $iconactivatecontent->icon !== "custom"
            && !empty($iconactivatecontent->icon);
        if ($hasstandardicon) {
            $icon = addslashes(strip_tags(strtolower($iconactivatecontent->icon)));
            $icon = str_replace(' ', '_', $icon);
            $iconactivatecontent->icon = '<div class="external-platform-icon icon-' .
                $icon . '">
                <img src="' . $CFG->wwwroot . '/mod/iconactivatecontent/pix/icon_' . $icon . '.svg"></div>';
        } else if ($iconactivatecontent->icon == "custom") {
            $icon = iconactivatecontent_get_uploaded_icon($coursemodule);
            if ($icon) {
                $iconactivatecontent->icon = '<div class="external-platform-icon"><img src="' . $icon->out() . '"></div>';
            } else {
                $iconactivatecontent->icon = '';
            }
        } else {
            $iconactivatecontent->icon = '';
        }
        $config = get_config('iconactivatecontent');
        $style = '';
        if (isset($config->width)) {
            $width = trim($config->width);
            if (preg_match('/^([0-9]*)(px|%)?$/', $width, $widthmatch)) {
                if (!isset($widthmatch[2])) {
                    $width .= 'px';
                }
                $style = ' style="max-width:' . $width . '" ';
            }
        }
        $info->content = $OUTPUT->render_from_template(
            'iconactivatecontent/view',
            array('info' => $iconactivatecontent, 'coursemodule' => $coursemodule, 'style' => $style)
        );
        $info->name = $iconactivatecontent->name;
        return $info;
    } else {
        return null;
    }
}

/**
 * @param object $coursemodule
 * @return false|moodle_url
 * @throws coding_exception
 */
function iconactivatecontent_get_uploaded_icon(object $coursemodule) {
    $context = context_module::instance($coursemodule->id);
    $fs = get_file_storage();
    $files = $fs->get_area_files(
        $context->id,
        'mod_iconactivatecontent',
        'customiconfilearea',
        0,
        'sortorder DESC, id ASC',
        false,
        0,
        0,
        1
    );
    if (count($files) === 0) {
        return false;
    }
    $file = current($files);
    $iconurl = moodle_url::make_pluginfile_url(
        $context->id,
        'mod_iconactivatecontent',
        'customiconfilearea',
        $file->get_itemid(),
        '/',
        $file->get_filename(),
        false
    );
    return $iconurl;

}

/**
 * Serves intro attachment files.
 *
 * @param mixed $course course or id of the course
 * @param mixed $cm course module or id of the course module
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options additional options affecting the file serving
 * @return bool false if file not found, does not return if found - just send the file
 */
function iconactivatecontent_pluginfile($course,
    $cm,
    context $context,
    $filearea,
    $args,
    $forcedownload,
    array $options = array()) {

    $itemid = (int)array_shift($args);

    $relativepath = implode('/', $args);

    $fullpath = "/{$context->id}/mod_iconactivatecontent/$filearea/$itemid/$relativepath";

    $fs = get_file_storage();
    $file = $fs->get_file_by_hash(sha1($fullpath));
    if (!$file || $file->is_directory()) {
        return false;
    }
    send_stored_file($file, 0, 0, $forcedownload, $options);
}
