<?php
declare(strict_types=1);

/**
 * Entity class representing a single question including the following:
 *
 *  - Difficulty level
 *  - Type of question (multiple/boolean)
 *  - Correct answer
 *  - Wrong answer(s)
 *  -
 *
 *
 * @see https://opentdb.com/api_config.php
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Entity;

class Question
{
    /**
     * Constant array holding available dificulty levels
     *
     * @var array
     */
    const DIFFICULTY_LEVELS = ['easy', 'medium', 'hard'];

    /**
     * Name of category
     *
     * @var string
     */
    protected string $CategoryName = '';

    /**
     * Level of question's difficulty
     * - easy
     * - medium
     * - hard
     *
     * @var string
     */
    protected string $difficultyLevel = '';


    /**
     * Type of question
     * - multiple
     * - boolean (true/false | yes/no)
     *
     * @var string
     */
    protected string $type = '';

    /**
     * List of wrong answers, or array with one single elemnt (if type == 'boolean')
     *
     * @var array
     */
    protected array $wrongAnswers = [];

    /**
     * Correct answer to current question
     *
     * @var string
     */
    protected string $correctAnswer = '';

    /**
     * @return bool
     */
    public function isAnsweredCorrectly(): bool
    {
        return $this->answeredCorrectly;
    }

    /**
     * @param bool $answeredCorrectly
     * @return Question
     */
    public function setAnsweredCorrectly(bool $answeredCorrectly): Question
    {
        $this->answeredCorrectly = $answeredCorrectly;
        return $this;
    }


    /**
     *
     * @return bool
     */
    public function getAnsweredCorrectly( ): bool
    {
        return $this->answeredCorrectly;
    }

    /**
     * Flag showing if correct answer was given
     *
     * @var bool
     */
    protected bool $answeredCorrectly = false;

    /**
     * The current question's text
     *
     * @var string
     */
    protected string $text;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Question
     */
    public function setText(string $text): Question
    {
        $this->text = $text;
        return $this;
    }


    /**
     * Answer given to current question by user
     *
     * @var string
     */
    protected string $givenAnswer = '';



    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->CategoryName;
    }

    /**
     * @param string $CategoryName
     * @return Question
     */
    public function setCategoryName(string $CategoryName): Question
    {
        $this->CategoryName = $CategoryName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDifficultyLevel(): string
    {
        return $this->difficultyLevel;
    }

    /**
     * @param string $difficultyLevel
     * @return Question
     */
    public function setDifficultyLevel(string $difficultyLevel): Question
    {
        $this->difficultyLevel = $difficultyLevel;
        return $this;
    }

    /**
     * Getter for type of question
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Question
     */
    public function setType(string $type): Question
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getWrongAnswers(): array
    {
        return $this->wrongAnswers;
    }

    /**
     * @param array $wrongAnswers
     * @return Question
     */
    public function setWrongAnswers(array $wrongAnswers): Question
    {
        $this->wrongAnswers = $wrongAnswers;
        return $this;
    }

    /**
     * @return string
     */
    public function getCorrectAnswer(): string
    {
        return $this->correctAnswer;
    }

    public function getAnswersForDisplay()
    {
        $tmp = array_merge([$this->getCorrectAnswer()], $this->getWrongAnswers());
        shuffle($tmp);
        return $tmp;
    }

    /**
     * @param string $correctAnswer
     * @return Question
     */
    public function setCorrectAnswer(string $correctAnswer): Question
    {
        $this->correctAnswer = $correctAnswer;
        return $this;
    }

    /**
     * @return string
     */
    public function getGivenAnswer(): string
    {
        return $this->givenAnswer;
    }

    /**
     * @param string $givenAnswer
     * @return Question
     */
    public function setGivenAnswer(string $givenAnswer): Question
    {
        $this->givenAnswer = $givenAnswer;
        return $this;
    }


    /**
     * Category constructor function
     *
     * @param int $id
     * @param string $name
     */
    public function __construct()
    {

    }


}