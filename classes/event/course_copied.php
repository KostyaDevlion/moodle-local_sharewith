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
 * The local_sharewith chapter viewed event.
 *
 * @package    local_sharewith
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_sharewith\event;
defined('MOODLE_INTERNAL') || die();

class course_copied extends \core\event\base {
    /**
     * Create instance of event.
     *
     * @since Moodle 2.7
     *
     * @param \stdClass $book
     * @param \context_module $context
     * @param \stdClass $chapter
     * @return chapter_viewed
     */
     
    public static function create_event($id, $eventdata) {
        
        $contextid = \context_course::instance($id);
        
        $data = array(
            'context' => $contextid,
            'other' => $eventdata
        );
        /** @var chapter_viewed $event */
                        
        $event = self::create($data);
        
        $f = new \stdClass();        
        //$event->add_record_snapshot('enter_maagar', $f);        
        return $event;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        $userid = $this->other['userid'];
        $new_courseid = $this->other['new_courseid'];
        $old_courseid = $this->other['old_courseid'];
        $category = $this->other['category'];
        $name_course = $this->other['name_course'];

        return "The user with id '$userid' copied course id '$old_courseid' to course '$name_course' with id '$new_courseid'";
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
        return get_string('eventcoursecopied', 'local_sharewith');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/course/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public static function get_objectid_mapping() {
        return array();
    }
}