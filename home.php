<?php
session_start();
//ユーザーがログインされてなかったらログインページへ戻す
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホームページ</title>
    <link href="stylesheet.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
    <div class="header-img">
        <nav class="navtop">
            <div>
                <?php var_dump($_SESSION); ?>
                <h1>travelist.</h1>
                <a href="profile.php"><i class="fas fa-user-circle"></i>プロフィール</a>
                <a href="#"><i class="fas fa-plus-circle"></i></i>アップロード</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>ログアウト</a>
            </div>
        </nav>
        <div class="wrap">
            <div class="search">
                <input type="text" class="searchTerm" placeholder="Nearest place to eat near me">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="content">
        <h2>HOME</h2>
        <p>Welcome back <?= $_SESSION['name'] ?>!</p>

    </div>
</body>

</html>