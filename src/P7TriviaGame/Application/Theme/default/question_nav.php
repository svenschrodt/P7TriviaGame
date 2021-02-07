
<header id="qunav">
<ul>
 <?php 
 for($i = 0; $i< $question_amount+1; $i++) {
 ?>
 	<li id="q_<?= $i?>" onclick="handleQuestion('question_<?= $i?>')">Question <?= $i+1?> </li>
 <?php 
}
 ?>
</ul>