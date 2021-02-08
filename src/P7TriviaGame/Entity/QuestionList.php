<?php


namespace P7TriviaGame\Entity;


class QuestionList
{

    /**
     * Array holding list of questions
     *
     * @var Question[]
     */
    protected array $data = [];

    /**
     * List of *keys* of questions, that were not given an answer to
     *
     * @var array
     */
    protected array $notAnswered = [];

    /**
     * @var int
     */
    protected  int $numberOfQuestions = 0;

    protected int $numberOfCorrectAnswers =0;

    /**
     * Get list of *keys* in question list, that were not given an answer to
     *
     * @return array
     */
    public function getNotAnswered(): array
    {
        return $this->notAnswered;
    }

    /**
     * Add *key* of question, that was not an answer given to
     *
     * @param int $key
     * @return Question
     */
    public function addNotAnswered(int $key): Question
    {
        $this->notAnswered[] = $key;
        return $this;
    }

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->numberOfQuestions = count($data);
    }

    /**
     * @return int
     */
    public function getNumberOfQuestions(): int
    {
        return $this->numberOfQuestions;
    }



    /**
     * @param int $numberOfQuestions
     * @return QuestionList
     */
    public function setNumberOfQuestions(int $numberOfQuestions): QuestionList
    {
        $this->numberOfQuestions = $numberOfQuestions;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfCorrectAnswers(): int
    {
        return $this->numberOfCorrectAnswers;
    }

    /**
     * @param int $numberOfCorrectAnswers
     * @return QuestionList
     */
    public function setNumberOfCorrectAnswers(int $numberOfCorrectAnswers): QuestionList
    {
        $this->numberOfCorrectAnswers = $numberOfCorrectAnswers;
        return $this;
    }


    /**
     *
     * @return QuestionList
     */
    public function increaseNumberOfCorrectAnswers(): QuestionList
    {
        $this->numberOfCorrectAnswers++;
        return $this;
    }
    /**
     * @return Question[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param Question[] $data
     * @return QuestionList
     */
    public function setData(array $data): QuestionList
    {
        $this->data = $data;
        return $this;
    }



}