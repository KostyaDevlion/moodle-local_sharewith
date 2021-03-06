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
 * Plugin administration pages are defined here.
 *
 * @package   local_sharewith
 * @copyright 2018 Devlion <info@devlion.co>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use tool_dataprivacy\output\categories;

global $PAGE;

$setting = new admin_settingpage('local_sharewith', get_string('pluginname', 'local_sharewith'));

if ($hassiteconfig) {
    $setting->add(new  admin_setting_configcheckbox(
        'local_sharewith/coursecopy',
        get_string('settingscoursecopy', 'local_sharewith'),
        get_string('settingscoursecopydesc', 'local_sharewith'),
        '1')
    );

    $setting->add(new  admin_setting_configcheckbox(
        'local_sharewith/sectioncopy',
        get_string('settingssectioncopy', 'local_sharewith'),
        get_string('settingssectioncopydesc', 'local_sharewith'),
        '1')
    );

    $setting->add(new  admin_setting_configcheckbox(
        'local_sharewith/activitycopy',
        get_string('settingsactivitycopy', 'local_sharewith'),
        get_string('settingsactivitycopydesc', 'local_sharewith'),
        '1')
    );

    $setting->add(new  admin_setting_configcheckbox(
        'local_sharewith/activitysending',
        get_string('settingsactivitysending', 'local_sharewith'),
        get_string('settingsactivitysendingdesc', 'local_sharewith'),
        '1')
    );

    $sql = "SELECT id, name, shortname
          FROM {role}
          ";

    $roles = $DB->get_records_sql($sql);
    $displayoptions = [];
    foreach ($roles as $role) {
        $displayoptions[$role->id] = $role->shortname;
    }

    $defaultdisplayoptions = array('1');

    $setting->add(new admin_setting_configmultiselect('local_sharewith/roles',
            get_string('rolesoptions', 'local_sharewith'),
            get_string('rolesdisplayoptions', 'local_sharewith'),
            $defaultdisplayoptions, $displayoptions));
}
$ADMIN->add('localplugins', $setting);
