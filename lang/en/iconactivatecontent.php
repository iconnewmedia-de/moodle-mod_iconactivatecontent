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
 * Plugin strings are defined here.
 *
 * @package     mod_iconactivatecontent
 * @category    string
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <pascal.collins@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['defaultheadline'] = 'Recommended external content';
$string['defaulttext'] = 'Here you find external content from [Platform], which complements this course and has been recommended by the teacher. You can activate and deactivate it by clicking on the toggle button.';
$string['defaultfooter'] = 'I agree to view external content. This can lead to transmission of personal data to third party platforms. More information in our data protection policy.';;
$string['preset'] = 'Preset';
$string['placeholder'] = '[Platform]';
$string['labelicon'] = 'Icon';
$string['labelheadline'] = 'Headline';
$string['labeltext'] = 'Text';
$string['labelfooter'] = 'Footer';
$string['none'] = 'None';
$string['uploadicon'] = 'Upload custom icon';
$string['name'] = 'Name';
$string['externalcontent'] = 'External content';
$string['externalcontent_help'] = 'Paste the code here that the external platform generates for you when you use their share button. It will usually start with &lt;iframe [...]&gt;';
$string['modulenameplural'] = 'ICON activate external content';
$string['modulename'] = 'ICON activate external content';
$string['pluginname'] = 'ICON activate external content';
$string['modulename_help'] = 'This activity provides an external content that gets displayed in an iframe after the user has clicked to confirm that he/she wants to view it';
$string['customicon'] = 'Custom icon';
$string['custom'] = 'Custom';
$string['currenticon'] = 'Current Icon: ';
$string['pluginadministration'] = 'Administration of activatable content';
$string['iconactivatecontentname'] = 'ICON activate external content ';
$string['iconactivatecontentname_help'] = 'For internal use - won\'t be displayed.';
$string['about'] = 'About';
$string['configuration'] = 'Configuration';
$string['plugindirectory'] = 'Moodle plugin directory page';
$string['abouttext'] = 'This plugin has been developed by {$a->abouticon}.<br /><br />It is part of a two plugin set for activating external content. The related filter plugin can be downloaded here: {$a->filtericonactivatecontent}. Both plugins work independently of each other.<br /><br />';
$string['aboutfeedbacktext'] = 'If you have any feedback or great ideas for new features, do not hesitate to leave a post on the {$a->aboutlink} or send an e-mail to {$a->aboutmail}.<br /><br />';
$string['filtericonactivatecontent'] = 'filter_iconactivatecontent';
$string['privacy:metadata'] = 'The plugin mod_iconactivatecontent does not store any personal data.';
$string['urlerror'] = 'Error - couldn\'t embed the requested URL';
$string['error_twitter_empty_response'] = 'Error - Received no response from Twitter';
$string['error_twitter_invalid_response'] = 'Error - Received invalid response from Twitter';
$string['error_unshorten'] = 'Error - Failed converting a short URL into the corresponing URL';
$string['settings'] = 'Activity ICON activate content settings';
$string['width'] = 'Maximum width (in pixels, or add % for percentage)';
