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

        $dbh = null;

    } catch(Exception $e) {
        // 通常本番環境ではエラー文は見せない
        $error_message = "障害発生によりご迷惑をおかけしています。: " . $e->getMessage() . "\n";
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ詳細</title>
</head>
<body>
    <?php if (!isset($error_message)) :?>
        <h2>スタッフ詳細</h2>
        <div>スタッフコード：<?= htmlspecialchars($member["code"], ENT_QUOTES, 'UTF-8') ?></div>
        <div>スタッフ名：<?= htmlspecialchars($member["name"], ENT_QUOTES, 'UTF-8') ?></div>
        <br>
        <a href="staff_list.php"><button>戻る</button></a>
    <?php else: ?>
        <h2>スタッフ参照</h2>
        <p style="color:tomato"><?= $error_message ?></p>
        <a href="staff_list.php"><button>戻る</button></a>
　　<?php endif; ?>
</body>
</html>