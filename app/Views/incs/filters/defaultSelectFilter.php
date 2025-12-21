<label for="<?= $data['id'] ?>"><?= $data['title'] ?></label>
<select name="<?= $data['name'] ?>" id="<?= $data['id'] ?>">
    <option value="" selected disabled><?= $data['disableItemText'] ?></option>
    <? foreach ($data['items'] as $item): ?>
        <option value="<?= $item['id'] ?>"><?= $item['name'] ?> <?= $item['notes'] ? "(" . $item['notes'] . ")" : "" ?></option>
    <? endforeach; ?>
</select>