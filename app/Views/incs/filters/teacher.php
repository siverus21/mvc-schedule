<label for="teacher">Преподаватель</label>
<select name="teacher" id="teacher">
    <option value="" selected disabled>Выберите преподавателя</option>
    <? foreach ($data['teachers'] as $item): ?>
        <option value="<?= $item['id'] ?>"><?= $item['name'] ?> <?= $item['academic_degree'] ? "(" . $item['academic_degree'] . ")" : "" ?></option>
    <? endforeach; ?>
</select>