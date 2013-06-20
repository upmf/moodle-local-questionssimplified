<?php
/**
 * @package    local
 * @subpackage questionssimplified
 * @copyright  2013 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace sqc;

global $DB;
/* @var $DB moodle_database */

class Answer
{
    /** @var integer */
    public $id;

    /** @var string */
    public $content;

    /** @var boolean */
    public $correct;

    public static function findAllByQuestion($qid) {
        global $DB;
        $records = $DB->get_records('question_answers', array('question' => $qid));
        $answers = array();
        foreach ($records as $record) {
            $answers[] = self::buildFromRecord($record);
        }
        return $answers;
    }

    /**
     * Returns a Answerinstance built from a record object.
     *
     * @param object $record
     * @return \sql\Answer
     */
    public static function buildFromRecord(\stdClass $record)
    {
        /**
         * @todo check that the answer has the fraction = 0|1
         */
        $answer = new self();
        $answer->id = $record->id;
        /**
         * @todo convert formated text into raw text
         */
        $answer->content = $record->answer;
        $answer->correct = $record->fraction == 1 ? true : false;
        return $answer;
    }
}


