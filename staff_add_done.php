<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff_done</title>
</head>
<body>
    <?php

    try {
        $staff_name = $_POST["name"];
        $staff_pass = $_POST["pass"];
        
        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

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

        echo $staff_name . "さんを追加しました。" . PHP_EOL;


    } catch (PDOException $e) {
        // 通常本番環境ではエラー文は見せない
        echo "障害発生によりご迷惑をおかけしています。: " . $e->getMessage() . "\n";
        exit();
    }


    ?>
    <a href="staff_list.php">戻る</a>
</body>
</html>