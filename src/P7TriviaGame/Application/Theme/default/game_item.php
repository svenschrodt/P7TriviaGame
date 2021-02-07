    <details class="game_item"<?= ($id==0) ? ' open' : '' ?>>
        <summary> <p>Question n° <?= $id+1 ?> - <?= $item->question?></p>
         <p><small>Category: <?= $item->category?> Difficulty: <i><?= $item->difficulty?></i></small></p></summary>
     <?php
     foreach ($answers as $aw => $answer) {
     ?>         <input type="radio" name="answer_question_<?= $id ?>" value="<?=$answer?>"> <?=$answer?><br>
     <?php
    }
     ?>
        <input type="hidden" name="is_answered_<?= $id ?>" value="0">
    </details>
