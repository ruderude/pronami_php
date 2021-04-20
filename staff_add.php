
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
</head>

<body>
    <h3>スタッフ追加</h3>
    <br>
    <form method="post" action="staff_add_check.php">
        スタッフ名を入力してください。<br>
        <input type="text" name="name" value="" style="width:200px"><br>
        パスワードを入力してください。 <br>
        <input type="password" name="pass1" style="width:100px"><br>
        パスワードをもう一度入力してください。 <br>
        <input type="password" name="pass2" style="width:100px"><br>
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>

</html>