<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package mod_iconactivatecontent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Define all the backup steps that will be used by the backup_iconactivatecontent_activity_task
 */

/**
 * Define the complete iconactivatecontent structure for backup, with file and id annotations
 */
class backup_iconactivatecontent_activity_structure_step extends backup_activity_structure_step {

    protected function define_structure() {

        // To know if we are including userinfo.
        $userinfo = $this->get_setting_value('userinfo');

        // Define each element separated.
        $iconactivatecontent = new backup_nested_element(
            'iconactivatecontent',
            array('id'),
            array(
                'name', 'intro', 'introformat', 'timemodified', 'headline', 'body', 'footer', 'icon'
            )
        );

        // Build the tree.
        // (love this).

        // Define sources.
        $iconactivatecontent->set_source_table('iconactivatecontent', array('id' => backup::VAR_ACTIVITYID));

        // Define id annotations.
        // (none).

        // Define file annotations.
        $iconactivatecontent->annotate_files(
            'mod_iconactivatecontent',
            'intro',
            null
        ); // This file area hasn't itemid.
        $iconactivatecontent->annotate_files(
            'mod_iconactivatecontent',
            'customiconfilearea',
            null
        ); // This file area hasn't itemid.

        // Return the root element (iconactivatecontent), wrapped into standard activity structure.
        return $this->prepare_activity_structure($iconactivatecontent);
    }
}
