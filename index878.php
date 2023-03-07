<?php
$form='
<form method="post">
<p><input type="text" name="textSave" placeholder="Введите текст для сохранения в файл"></p>
<p><input type="submit" value="Сохранить"></p>
</form>';
echo $form;

if(isset($_POST["textSave"])){
    try {
        $file = '.textSave.txt';
        file_put_contents($file, $_POST["textSave"]);
        echo $_POST["textSave"];
    } catch (Throwable $t){
        echo $t->getMessage();
    }


}
echo "seva";

phpinfo();

