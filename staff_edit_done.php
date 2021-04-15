<?php

    try {
        $staff_name = trim($_POST["name"]);
        $staff_code = trim($_POST["code"]);
        
        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');

        // var_dump($staff_name);
        // var_dump($staff_code);

        $dsn = 'mysql:dbname=shop;host=127.0.0.1';
        $user = 'admin';
        $password = 'password';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = "UPDATE mst_staff SET name = :name WHERE code = :code";

        $sql = "UPDATE mst_staff SET name = :name WHERE code = :code";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':name', $staff_name, PDO::PARAM_STR);
        $stmt->bindValue(':code', $staff_code, PDO::PARAM_INT);
        $stmt->execute();

        $dbh = null;

        $message = $staff_name . "さんを修正しました。" . PHP_EOL;


    } catch (PDOException $e) {
        // 通常本番環境ではエラー文は見せない
        $message = "障害発生によりご迷惑をおかけしています。: " . $e->getMessage() . "\n";
        exit();
    }


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff_edit_done</title>
</head>
<body>
    <h4><?= $message ?></h4>
    <a href="staff_list.php">戻る</a>
</body>
</html>