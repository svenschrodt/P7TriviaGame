<?php
declare(strict_types=1);
/**
 * GameSolver - class solving current game
 *
 *  - evaluating given answers
 *  - calculating stats
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */


namespace P7TriviaGame\Application;


use P7TriviaGame\Entity\Question;
use P7TriviaGame\Entity\QuestionList;

class GameSolver
{

    /**
     * @var QuestionList
     */
    protected QuestionList $list;

    /**
     * List of questions retrieved from API | cache
     *
     * @var Question[]
     */
    protected array $questions;

    /**
     * List of answers given by user
     *
     * @var array
     */
    protected array $answers;


    public function __construct(QuestionList $questions, array $givenAnswers)
    {
        //@FIXME implement \Iterable etc. for QuestionList
        $this->questions = $questions->getData();
        $this->list = $questions;
        $this->answers = $givenAnswers;
        $this->injectGivenAnswers();
        $this->run();
    }

    protected function solveQuestion(Question $question)
    {
        $result = ($question->getCorrectAnswer() === $question->getGivenAnswer());
        if($result === true) {
            $this->list->increaseNumberOfCorrectAnswers();
        }
        $question->setAnsweredCorrectly($result);
    }

    public function run()
    {
        foreach ($this->questions as $question) {
            $this->solveQuestion($question);
        }
    }

    protected function injectGivenAnswers()
    {
        for($i=0;$i<count($this->questions);$i++) {
            if(!isset($this->answers[$i])) {
               $this->list->addNotAnswered($i);
            } else {
                $this->questions[$i]->setGivenAnswer($this->answers[$i]);
            }
        }
    }
}