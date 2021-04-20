<?php

    try {
        $staff_name = trim(mb_convert_kana($_POST["name"], "s", 'UTF-8'));
        $staff_pass = trim(mb_convert_kana($_POST["pass"], "s", 'UTF-8'));
        
        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

        // パスワードを暗号化
        $staff_pass = md5($staff_pass);

        $dsn = 'mysql:dbname=shop;host=127.0.0.1';
        $user = 'admin';
        $password = 'password';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "データベース接続成功\n";

        // SQLインジェクション用のSQL文
        //ここから
        // $sql = "SELECT * FROM mst_staff WHERE name = '".$_POST['name']."' AND password = '".$_POST['pass']."'";
        // $data = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($data);
        // ここまで

        $sql = "INSERT INTO mst_staff (name, password) VALUES (:name, :password)";

        $stmt = $dbh->prepare($sql);
        
        //クエリの設定
        $stmt->bindValue(':name', $staff_name);
        $stmt->bindValue(':password', $staff_pass);

        //クエリの実行
        $stmt->execute();

        $dbh = null;

        $message = $staff_name . "さんを追加しました。<br>";

    } catch (PDOException $e) {
        // 通常本番環境ではエラー文は見せない
        $error_message =  "障害発生によりご迷惑をおかけしています。: " . $e->getMessage() . "\n";
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff_done</title>
</head>
<body>
    <?php if (!isset($error_message)) :?>
        <h2>スタッフ追加完了!</h2>
        <div><?= $message ?></div>
        <a href="staff_list.php"><button>戻る</button></a>
    <?php else: ?>
        <p style="color:tomato"><?= $error_message ?></p>
        <a href="staff_list.php"><button>戻る</button></a>
　　<?php endif; ?>

</body>
</html>