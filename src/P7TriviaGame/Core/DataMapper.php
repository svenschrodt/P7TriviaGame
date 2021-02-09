<?php
/**
 * Class mapping data structures for usage within different APIs and application:
 *
 *  - external API (https)
 *  - internal API to file cache
 *  - internal API to rel. data base systems )
 *  - API abstracted structures used by application itself (@see P7TriviaGame\Entity)
 *
 * @TODO DI-Container 4 cfg
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Core;

use P7TriviaGame\Entity\Category;
use P7TriviaGame\Entity\CategoryList;
use P7TriviaGame\Entity\Question;
use P7TriviaGame\Communication\FileCacheClient;

class DataMapper
{

    const DB_ENTITY_QUESTION = 'question';

    const DB_ENTITY_ANSWER = 'question_answer';

    const DB_ENTITY_CATEGORY = 'category';

    public static ?CategoryList $categoryList = null;

    public function mapQuestionToSql(Question $question)
    {

    }

    /**
     * Mapping category entities from DB to instance of CategoryList
     *
     * @param array $data
     * @return CategoryList
     */
    public function mapArrayToCategoryList(array $data) : CategoryList
    {
        $list = new CategoryList();
        foreach ($data as $item) {
            $created = \DateTime::createFromFormat('Y-m-d H:i:s', $item->created);
            $tmp = new Category($item->id, $item->c_text, $item->api_id, $created);
            $list->addToIndex($item->id);
            $list->push($tmp);
        }
        return $list;
    }

    public function mapQuestionToSqlValuesClause(Question $question)
    {


        //INSERT INTTO question          (id,      q_text,   diffulty-level, q,type, created, category_id)
        $catList = self::getCategoryList();

        $id = md5($question->getText());
        $text = $question->getText();
        $diff = $question->getDifficultyLevel();
        $type = $question->getType();
        $created = date('Y-m-d H:i:s');
        $catId = $catList->getByName($question->getCategoryName())->getId();
        $sql = [];
        // Into table question  (id,      q_text,   diffulty-level, q,type, created, category_id)
        $sql[] = "REPLACE INTO `question` VALUES ('$id', '$text', '$diff', '$type', '$created', '$catId');";
        // Into table
        //tpl

        $sqlTwo =  "INSERT INTO question_answer (question_id,   qa_text, label) VALUES";

        foreach ($question->getWrongAnswers() as $answerWrong) {
            $qatext = $answerWrong;
            $sqlTwo .= "\n('$id', '$qatext', 'wrong'),";
        }

        $answerCorrect = $question->getCorrectAnswer();
        $sqlTwo .= "\n('$id', '$answerCorrect', 'correct')";

        $sql[] = $sqlTwo;

        return $sql;
    }


    public function mapArrayToQuestionList()
    {

    }

    public static function getCategoryList()
    {
        if(is_null(self::$categoryList)) {
            //@TODO decide: API, file or DB
            $fcc = new FileCacheClient();
            self::$categoryList = $fcc->getCategories();
        }
       return self::$categoryList;
    }
}