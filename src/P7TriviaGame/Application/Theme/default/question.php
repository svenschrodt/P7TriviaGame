<!-- Start question n° <?=$i?> -->
    <details class="game_item" open>
        <summary><p>Question n°<?=$i?> <?= $item->getText() ?></p>
            <p><small>Category:<i><?= $item->getCategoryName() ?></i>
                      Difficulty: <i><?= $item->getDifficultyLevel() ?></i>
                </small></p>
        </summary>
        <p>

            <?php print_r($item->getAnswersForDisplay());

            ?></p>
        <hr><p>
            <span style="color: darkgreen; font: bold">
            <?php echo $item->getCorrectAnswer();

            ?></span>
        </p><hr>
    </details>
<!-- End question n° <?=$i?> -->
