<?php


namespace P7TriviaGame\Application;

use P7TriviaGame\Communication\HttpProtocol;
use P7TriviaGame\Communication\HttpRequest;
use P7TriviaGame\Communication\HttpResponse;
use P7TriviaGame\Core\Utility;
use P7TriviaGame\Persistence\Session;
use P7TriviaGame\Application\View;

class FrontController
{

    protected ?HttpRequest $request = null;
    protected ?HttpResponse $response = null;
    protected ?View $view = null;
    protected ?Session $session = null;
    protected string $currentAction = '';

    public function __construct(HttpRequest $request, HttpResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = Session::getInstance();
        $this->view = new View();
        $this->process();
    }

    protected function process()
    {
        switch ($this->request->getAction()) {


            case '':
            case 'start' :
                $this->start();
                break;

            case 'solve' :
                $this->solve();
                break;

            default: // 404
                $this->response->setStatus(HttpProtocol::STATUS_CODE_NOT_FOUND);
                $this->noRoute();
        }
    }

    protected function start()
    {
        Utility::startMeasuring();
        $content = '';


        //@TODO configurable
        $amount = 12;
        $g = new \P7TriviaGame\Entity\Game($amount);
        $this->view->setProperty('id', 0);
        $this->view->setProperty('amount', $amount);
        $questions = ($g->getQuestionList());

        $this->session->set('questions', new \P7TriviaGame\Entity\QuestionList($questions));
        foreach ($questions as $question) {
            $this->view->setProperty('item', $question);
            $content .=  $this->view->render('game_item.php');
        };

        $this->sendResponse( $this->view->renderDocument($content));
    }

    protected function solve()
    {
        Utility::startMeasuring();
        $content = '';
        $questions = $this->session->get('questions');

        $solver = new \P7TriviaGame\Application\GameSolver($questions, $_POST['answer_question']);
        $this->session->set('questions', $questions);

        $this->view->setProperty('questions', $questions);
        $content .=  $this->view->render('game_solved.php');
        $this->sendResponse( $this->view->renderDocument($content, View::DOCUMENT_WO_FORM_TEMPLATE));
    }

    protected function noRoute()
    {
        echo __FUNCTION__;
    }

    protected function sendResponse($content)
    {
        $this->response->finalize();
        echo $content;
    }

}