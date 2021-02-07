<select name="trivia_category" class="form-control">
    <option value="0>">any</option>
    <?php
    foreach ($categories as $category) :
        ?>
        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
    <?php
    endforeach;
    ?>
</select>