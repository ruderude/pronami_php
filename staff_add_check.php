<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チェック</title>
</head>
<body>
    <?php
    // var_dump($_POST);
    $staff_name = $_POST["name"];
    $staff_pass1 = $_POST["pass1"];
    $staff_pass2 = $_POST["pass2"];

    $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
    $staff_pass1 = htmlspecialchars($staff_pass1, ENT_QUOTES, 'UTF-8');
    $staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');

    if($staff_name == '') {
        print 'スタッフ名が入力されていません。<br />';
    } else {
        print 'スタッフ名：';
        print $staff_name;
        print '<br />';
    }

    if($staff_pass1 == '' || $staff_pass2 == ''){
        print 'パスワードが空です。<br />';
    }

    if($staff_pass1 != $staff_pass2) {
        print 'パスワードが一致しません。<br />';
    }

    if ($staff_name == '' || $staff_pass1 == '' || $staff_pass1 != $staff_pass2) {
        print
        '<form>';
        print
        '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    } else {
        $staff_pass1 = md5($staff_pass1);
        print
        '条件OKです。';
        print
        '<form method="post" action="staff_add_done.php">';
        print
        '<input type="hidden" name="name" value="' . $staff_name . '">';
        print
        '<input type="hidden" name="pass" value="' . $staff_pass1 . '">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="OK">';
    }
    ?>
</body>
</html>