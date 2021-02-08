<?php
//header('Content-Type: text/plain');
require_once 'Autoload.php';

use P7TriviaGame\Core\Utility;
use P7TriviaGame\Application\Runner;
use P7TriviaGame\Communication\ApiClient;
use P7TriviaGame\Application\View;

Utility::startMeasuring();
$content = '';
$v = new View();
$session = \P7TriviaGame\Core\Factory::get('session');

$amount = 12;
$g = new \P7TriviaGame\Entity\Game($amount);
$v->setProperty('id', 0);
$v->setProperty('amount', $amount);
$questions = ($g->getQuestionList());

$session->set('questions', new \P7TriviaGame\Entity\QuestionList($questions));
foreach ($questions as $question) {
    $v->setProperty('item', $question);
    $content .= $v->render('game_item.php');
};

echo $v->renderDocument($content);
//$v->theme = \P7TriviaGame\Application\Configuration::APPLICATION_THEME;
//echo $v->render('document.php');