<?php
    try {
        $staff_code = $_GET["staff_code"];

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

        var_dump($member);

        $dbh = null;

    } catch(Exception $e) {
        // 通常本番環境ではエラー文は見せない
        echo "障害発生によりご迷惑をおかけしています。: " . $e->getMessage() . "\n";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
<h2>スタッフ修正</h2>
<h4>スタッフコード：<?= $member["code"] ?></h4>
<br>
<form method="post" action="staff_edit_check.php">
    スタッフ名<br>
    <input type="hidden" name="code" value="<?= $member["code"] ?>" >
    <input type="text" name="name" value="<?= $member["name"] ?>" style="width:200px"><br>
    <!-- パスワードを入力してください。 <br>
    <input type="password" name="pass1" style="width:100px"><br>
    パスワードをもう一度入力してください。 <br>
    <input type="password" name="pass2" style="width:100px"><br> -->
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK"><br>
</form>

</body>
</html>