<?php
    ini_set('display_errors', "On");

    try {
        $dsn = 'mysql:dbname=shop;host=127.0.0.1';
        $user = 'admin';
        $password = 'password';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT code, name FROM mst_staff";

        $stmt = $dbh->query($sql);
        $stmt->execute();

        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dbh = null;
        
        // var_dump($members);
    } catch (Exception $e) {
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
    <title>スタッフ一覧</title>
</head>
<body>
    <h2>スタッフ一覧</h2>
    <?php if (isset($error_message)) :?>
        <p style="color:tomato"><?= $error_message ?></p>
　　<?php endif; ?>

    <form method="post" action="staff_branch.php">

        <!-- HTMLにPHPのforeachを組み込ませる書き方 -->
        <?php foreach ($members as $member) : ?>
            <label><input type="radio" name="staff_code" id="<?= $member["code"] ?>" value="<?= $member["code"] ?>"><?= $member["name"] ?></label><br>
        <!-- 最後は endforeach と；（セミコロン）で閉じる -->
        <?php endforeach; ?>

        <input type="submit" name="add" value="追加">
        <input type="submit" name="disp" value="詳細">
        <input type="submit" name="edit" value="修正">
        <input type="submit" name="delete" value="削除">
        
    </form>
    

</body>
</html>