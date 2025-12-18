<label for="classroom">Аудитория</label>
<select name="classroom" id="classroom">
    <option value="" selected disabled>Выберите аудиторию</option>
    <? foreach ($data['auditories'] as $item): ?>
        <option value="<?= $item['id'] ?>"><?= $item['name'] ?> <?= $item['building_name'] ? "(" . $item['building_name'] . ")" : "" ?></option>
    <? endforeach; ?>
</select>