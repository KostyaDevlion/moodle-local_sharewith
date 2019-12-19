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
 * The mod_book chapter viewed event.
 *
 * @package    mod_book
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_sharewith\event;
defined('MOODLE_INTERNAL') || die();

class activity_to_teacher_copy extends \core\event\base {
    /**
     * Create instance of event.
     *
     * @since Moodle 2.7
     *
     * @param \stdClass $book
     * @param \context_module $context
     * @param \stdClass $chapter
     * @return \core\event\base
     */

    public static function create_event($eventdata) {

        $contextid = \context_course::instance($eventdata['courseid']);

        $data = array(
                'context' => $contextid,
                'other' => $eventdata,
        );

        return self::create($data);
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        $useridto = $this->other['targetuserid'];
        $useridfrom = $this->other['userid'];
        $activityid = $this->other['instanceid'];
        return "The user with id '$useridfrom' shared activity id '$activityid' with user id '$useridto'";
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        return array();
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcopytoteacher', 'local_sharewith');
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public static function get_objectid_mapping() {
        return array();
    }
}
