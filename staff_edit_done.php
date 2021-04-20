<?php

    try {
        $staff_name = trim(mb_convert_kana($_POST["name"], "s", 'UTF-8'));
        $staff_code = trim(mb_convert_kana($_POST["code"], "s", 'UTF-8'));
        
        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');

        $dsn = 'mysql:dbname=shop;host=127.0.0.1';
        $user = 'admin';
        $password = 'password';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE mst_staff SET name = :name WHERE code = :code";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':name', $staff_name, PDO::PARAM_STR);
        $stmt->bindValue(':code', $staff_code, PDO::PARAM_INT);
        $stmt->execute();

        $dbh = null;

        $message = $staff_name . "さんを更新しました。<br>";


    } catch (PDOException $e) {
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
    <title>スタッフ更新</title>
</head>
<body>
    <?php if (!isset($error_message)) :?>
        <h2>スタッフ更新完了！</h2>
        <div><?= $message ?></div>
        <a href="staff_list.php"><button>戻る</button></a>
    <?php else: ?>
        <p style="color:tomato"><?= $error_message ?></p>
        <a href="staff_list.php"><button>戻る</button></a>
　　<?php endif; ?>
</body>
</html>