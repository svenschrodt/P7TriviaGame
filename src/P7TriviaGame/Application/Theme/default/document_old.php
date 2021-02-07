<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trivia Game version 0.1</title>
    <link href="styles/screen.css" rel="stylesheet">
<body>
<form action="solve.php" method="post">
    <h1>Trivia Game version 0.1 - you answered
        <meter min="0" max="10" value="0" id="pogress"></meter>

        <select name="trivia_category" class="form-control">
            <option value="any">Any Category</option>
            <option value="9">General Knowledge</option>
            <option value="10">Entertainment: Books</option>
            <option value="11">Entertainment: Film</option>
            <option value="12">Entertainment: Music</option>
            <option value="13">Entertainment: Musicals &amp; Theatres</option>
            <option value="14">Entertainment: Television</option>
            <option value="15">Entertainment: Video Games</option>
            <option value="16">Entertainment: Board Games</option>
            <option value="17">Science &amp; Nature</option>
            <option value="18">Science: Computers</option>
            <option value="19">Science: Mathematics</option>
            <option value="20">Mythology</option>
            <option value="21">Sports</option>
            <option value="22">Geography</option>
            <option value="23">History</option>
            <option value="24">Politics</option>
            <option value="25">Art</option>
            <option value="26">Celebrities</option>
            <option value="27">Animals</option>
            <option value="28">Vehicles</option>
            <option value="29">Entertainment: Comics</option>
            <option value="30">Science: Gadgets</option>
            <option value="31">Entertainment: Japanese Anime &amp; Manga</option>
            <option value="32">Entertainment: Cartoon &amp; Animations</option>
        </select>
        <output id="sum">0</output>
        /
        <output id="answ"><?= $amount ?></output>
    </h1>
    <?= $content ?>
    <button>check answers</button>
</form>
<footer class="bottom">
    2020 by Sven Schrodt - details on <a href="https://github.com/svenschrodt/TriviaGame">GitHub</a>
    <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Ftrivia.schrodt-service.net%2F">Check HTML</a>
</footer>
<script src="scripts/main.js"></script>
</body>
</html>