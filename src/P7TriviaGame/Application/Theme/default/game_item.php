<?php $this->setProperty('id', $this->getProperty('id')+1); ?>




    <fieldset class="game_item">
         <legend class="question_top"><small>Question <?=$this->getProperty('id') ?> of <?=$this->getProperty('amount')?> -
                 Category: <i><?= $this->getProperty('item')->getCategoryName()?></i>
                 Difficulty: <i><?= $this->getProperty('item')->getDifficultyLevel()?></i>
            </small>
             <blockquote><?=  $this->getProperty('item')->getText()?></blockquote>
         </legend>

     <?php
     foreach ($this->getProperty('item')->getAnswersForDisplay() as $aw => $answer) :
     ?>        <label class="single_question" for="" onclick="activate(this)">
                  <input required type="radio" name="answer_question[<?= $this->getProperty('id')-1 ?>]" value="<?=$answer?>">
                  <?=$answer?>
                </label>

     <?php
    endforeach;
     ?>
    </fieldset>
