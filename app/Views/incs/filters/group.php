<label for="group">Группа</label>
<select name="group" id="group">
    <option value="" selected disabled>Выберите группу</option>
    <? foreach ($data['groups'] as $item): ?>
        <option value="<?= $item['id'] ?>"><?= $item['name'] ?> <?= $item['notes'] ? "(" . $item['notes'] . ")" : "" ?></option>
    <? endforeach; ?>
</select>