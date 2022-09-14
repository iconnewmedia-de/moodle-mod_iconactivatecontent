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
 * Resource module admin settings and defaults
 *
 * @package    mod_iconactivatecontent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    $ADMIN->add('modsettings', new admin_category('iconactivatecontentfolder',
        get_string('pluginname', 'mod_iconactivatecontent')));

    $settings = new admin_settingpage($section, get_string('settings', 'mod_iconactivatecontent'), 'moodle/site:config');

    $settings->add(new admin_setting_configtext('iconactivatecontent/width',
            get_string('width', 'mod_iconactivatecontent'),
            '',
            900,
            PARAM_TEXT,
            60
        )
    );
    $ADMIN->add('iconactivatecontentfolder', $settings);

    $ADMIN->add('iconactivatecontentfolder', new admin_externalpage('iconactivatecontent_about',
        get_string('about', 'mod_iconactivatecontent'), new moodle_url('/mod/iconactivatecontent/about.php')));

    $settings = null;
}

