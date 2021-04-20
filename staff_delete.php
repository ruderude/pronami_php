<?php
    try {
        $staff_code = trim(mb_convert_kana($_GET["staff_code"], "s", 'UTF-8'));

        $staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');

        $dsn = 'mysql:dbname=shop;host=127.0.0.1';
        $user = 'admin';
        $password = 'password';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT code, name FROM mst_staff WHERE code = :code";

        $stmt = $dbh->prepare($sql);
        
        //クエリの設定
        $stmt->bindValue(':code', $staff_code);

        //クエリの実行
        $stmt->execute();

        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($member);

        $dbh = null;

    } catch(Exception $e) {
        // 通常本番環境ではエラー文は見せない
        $error_message =  "障害発生によりご迷惑をおかけしています。: " . $e->getMessage() . "\n";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <h2>スタッフ削除</h2>
    <?php if (isset($error_message)) :?>
        <p style="color:tomato"><?= $error_message ?></p>
　　<?php endif; ?>

    <h4>スタッフコード：<?= htmlspecialchars($member["code"], ENT_QUOTES, 'UTF-8') ?></h4>
    このスタッフを削除してよろしいですか？
    <form method="post" action="staff_delete_done.php">
        スタッフ名：<strong></ｓ><?= htmlspecialchars($member["name"], ENT_QUOTES, 'UTF-8') ?></strong><br>
        <input type="hidden" name="code" value="<?= htmlspecialchars($member["code"], ENT_QUOTES, 'UTF-8') ?>" >
        <input type="hidden" name="name" value="<?= htmlspecialchars($member["name"], ENT_QUOTES, 'UTF-8') ?>" >
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="削除する"><br>
    </form>

</body>
</html>