<pre>
<?php
require_once 'Autoload.php';
$session = \P7TriviaGame\Persistence\Session::getInstance();
//
//var_dump($_POST);
//var_dump($session->get('questions'));
$questions = $session->get('questions');
$solver = new \P7TriviaGame\Application\GameSolver($questions, $_POST['answer_question']);
foreach($questions->getData() as $q) {
  echo $q->getText();
echo PHP_EOL;
    echo 'Correct is :' . $q->getCorrectAnswer();
    echo PHP_EOL;
    echo 'Given was :' .$q->getGivenAnswer();

    echo PHP_EOL;
    echo 'result is: ' . (int) $q->getAnsweredCorrectly();
    echo '<hr>';
};
echo 'RESULT:::'. PHP_EOL;
echo 'Number of questions: ' . $questions->getNumberOfQuestions();echo PHP_EOL;
echo 'Number of correct answers: ' . $questions->getNumberOfCorrectAnswers();echo PHP_EOL;
echo ($questions->getNumberOfCorrectAnswers() / $questions->getNumberOfQuestions() *100) . '%';
echo PHP_EOL;
var_dump($questions);