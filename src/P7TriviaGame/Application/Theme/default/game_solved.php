<?php
$questions = $this->getProperty('questions');
?>
<?php
?>
<details>
    <summary>
        <h4>Your result:</h4>
            <ul class="result">
            <li><span class="li_title">Number of questions: <?= $questions->getNumberOfQuestions()?></span></li>
            <li><span class="li_title">Number of correct answers: <?= $questions->getNumberOfCorrectAnswers()?></span></li>
            <li><?= $questions->getNumberOfCorrectAnswers() / $questions->getNumberOfQuestions() *100 ?> %</li>
        </ul>
    </summary>
    <?php
    foreach($questions ->getData() as $q) :
         $resultClass = ($q->getAnsweredCorrectly())  ? 'right' : 'wrong';
        ?>
        <blockquote><?= $q->getText() ?></blockquote>
        <ul class="result">
            <li><span class="li_title">Correct is:</span><span class="correct"><?= $q->getCorrectAnswer() ?></span></li>
            <li><span class="li_title">You answered:</span><span class="<?=$resultClass?>"><?= $q->getGivenAnswer() ?></span> </li>
        </ul>
    <?php endforeach; ?>
</details>
