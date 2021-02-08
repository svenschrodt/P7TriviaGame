<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->getTitle() ?></title>
    <link href="theme/<?= $this->theme?>/style/screen.css" rel="stylesheet">
<body>
<header>
    <h1> <?= $this->getTitle() ?></h1>
</header>
<section id="game">

    <?= $this->content ?>


</section>

<footer class="bottom">
    <ul class="info_meta">
        <li><small>| © 2021 by Sven Schrodt </small> </li>
        <li><small>| rendering time: <?=$this->getRenderTime()?> </small> </li>
        <li><small>| PHP <?=phpversion()?> </small>    </li>
        <li> <a href="https://github.com/svenschrodt/TriviaGame">GitHub</a> </li>
        <li> <a href="https://travis-ci.org/github/svenschrodt/P7TriviaGame">Travis CI</a> </li>
        <li> <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Ftrivia.schrodt-service.net%2F">Check HTML</a></li>
    </ul>
</footer>
<script src="theme/<?= $this->theme?>/script/application.js"></script>
</body>
</html>