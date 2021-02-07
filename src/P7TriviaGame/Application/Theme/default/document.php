<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->getTitle() ?></title>
    <link href="theme/<?= $this->theme?>/style/screen.css" rel="stylesheet">
<body>

    <?= $this->content ?>

<footer class="bottom">
    2020 by Sven Schrodt - details on <a href="https://github.com/svenschrodt/TriviaGame">GitHub</a>
    <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Ftrivia.schrodt-service.net%2F">Check HTML</a>
</footer>
<script src="theme/<?= $this->theme?>/script/main.js"></script>
</body>
</html>