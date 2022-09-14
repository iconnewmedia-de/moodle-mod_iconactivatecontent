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
 * Local Library of interface functions and constants.
 * Contains functions that don't belong to the standard functions that are expected in lib.php
 *
 * @package     mod_iconactivatecontent
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <pascal.collins@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @param $moduleinstance
 * @param $mform
 *
 * @return void
 * @throws coding_exception
 */
function iconactivatecontent_save_customicon($moduleinstance, $mform) {
    if (is_null($mform)) {
        return;
    }
    $data = $mform->get_data();

    $cmid = $moduleinstance->coursemodule;
    $context = context_module::instance($cmid);
    if (!isset($data->customicon)) {
        return;
    }
    file_save_draft_area_files(
        $data->customicon,
        $context->id,
        'mod_iconactivatecontent',
        'customiconfilearea',
        0,
        array(
            'subdirs' => 0,
            'maxfiles' => 1,
            'accepted_types' => 'web_image'
        )
    );
}
