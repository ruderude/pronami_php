<?php
    // var_dump($_POST);
    $staff_code = trim($_POST["code"]);
    $staff_name = trim($_POST["name"]);
    // $staff_pass1 = trim($_POST["pass1"]);
    // $staff_pass2 = trim($_POST["pass2"]);

    $staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');
    $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
    // $staff_pass1 = htmlspecialchars($staff_pass1, ENT_QUOTES, 'UTF-8');
    // $staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');

    $error_messages = [];

    if($staff_name == '') {
        $error_messages[] = 'スタッフ名が入力されていません';
    } elseif(mb_strlen($staff_name) >= 15) {
        $error_messages[] = 'スタッフ名が長すぎます';
    }

    // var_dump($_POST);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集チェック</title>
</head>
<body>
    <?php if (empty($error_messages)) :?>
        条件OKです。
        <h4>スタッフ名：<?= $staff_name ?> に修正しますか？</h4>
        <form method="post" action="staff_edit_done.php">
        <input type="hidden" name="name" value="<?= $staff_name ?>">
        <input type="hidden" name="code" value="<?= $staff_code ?>">
        <br />
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
　　<?php else: ?>
        <?php foreach ($error_messages as $error) : ?>
            <div style="color:tomato"><?= $error ?></div>
        <?php endforeach; ?>
        <input type="button" onclick="history.back()" value="戻る">
　　<?php endif; ?>
</body>
</html>