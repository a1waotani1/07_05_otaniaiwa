<?php
session_start();
//ユーザーがログインされてなかったらログインページへ戻す
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gsacf_d06_05';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT username, password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->bind_result($username, $password, $email);
$stmt->execute();
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>プロフィールページ（編集画面）</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
    <div class="header-img">
        <nav class="navtop">
            <div>
                <h1>travelist.</h1>
                <a href="profile.php"><i class="fas fa-user-circle"></i>プロフィール</a>
                <a href="#"><i class="fas fa-plus-circle"></i></i>アップロード</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>ログアウト</a>
            </div>
        </nav>
    </div>
    <div class="content">
        <h2>プロフィールページ（編集画面）</h2>
        <div>
            <p>アカウント情報は以下に記載されています:</p>
            <form action="profile_update.php" method="POST">
                <table>

                    <tr>
                        <td>ユーザー名:</td>
                        <td><?= $_SESSION['name'] ?></td>
                    </tr>

                    <tr>
                        <td>新しいユーザー名:</td>
                        <td><input type="text" name="newusername" value="<?= $_SESSION['name'] ?>"></td>
                    </tr>
                    <tr>
                        <td>パスワード:</td>
                        <td><?= $password ?></td>
                    </tr>
                    <tr>
                        <td>メールアドレス:</td>
                        <td><?= $email ?></td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="submit2" value="保存する"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>
</body>

</html>