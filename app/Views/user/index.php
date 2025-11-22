<div class="container">
    <? // dd($users) 
    ?>

    <?
    foreach ($users as $user) {
        echo $user["name"] . '<br>';
    }
    ?>
</div>