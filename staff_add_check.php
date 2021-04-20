<?php

    $staff_name = trim(mb_convert_kana($_POST["name"], "s", 'UTF-8'));
    $staff_pass1 = trim(mb_convert_kana($_POST["pass1"], "s", 'UTF-8'));
    $staff_pass2 = trim(mb_convert_kana($_POST["pass2"], "s", 'UTF-8'));

    $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
    $staff_pass1 = htmlspecialchars($staff_pass1, ENT_QUOTES, 'UTF-8');
    $staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');

    $error_messages = [];

    if($staff_name == '') {
        $error_messages[] = 'スタッフ名が入力されていません。<br />';
    } elseif(mb_strlen($staff_name) >= 20) {
        $error_messages[] = 'スタッフ名が長すぎます';
    } else {
        $message = 'スタッフ名：' . $staff_name . '<br>';
    }

    if($staff_pass1 == '' || $staff_pass2 == ''){
        $error_messages[] = 'パスワードが空です。<br />';
    }

    if($staff_pass1 != $staff_pass2) {
        $error_messages[] = 'パスワードが一致しません。<br />';
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ追加チェック</title>
</head>
<body>
    <?php if (empty($error_messages)) :?>
        スタッフ追加条件OKです。
        <h4>スタッフ名：<?= $staff_name ?> を追加しますか？</h4>
        <form method="post" action="staff_add_done.php">
            <input type="hidden" name="name" value="<?= $staff_name ?>">
            <input type="hidden" name="pass" value="<?= $staff_pass1 ?>">
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
　　<?php else: ?>
        <?php foreach ($error_messages as $error) : ?>
            <div style="color:tomato"><?= $error ?></div>
        <?php endforeach; ?>
        <input type="button" onclick="history.back()" value="戻る">
　　<?php endif; ?>
</body>
</html>