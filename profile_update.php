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
/**
 *  ここでSESSION['id']使うならformの方からPOSTでid渡さなくても良さそうですねー（なのでprofile_edit.phpから削除しました）
 * 実はinput type=hiddenでPOSTする方法はユーザーが勝手に書き換えることも可能なので、SESSIONで実装しているこのやり方の方がいいかもしれませんねー。
 * */
$id = $_SESSION['id'];
$username = $_SESSION['name'];
$newusername = $_POST['newusername'];


if (isset($_POST['username'])) {
    /**
     * comment : ここはSELECTした後にUPDATEする必要はなくて、UPDATEのSQL文の中で
     *  accountsの中でWHERE id='$id'としているので、更新すべき場所は特定できていますね
     */
    $stmt = $con->prepare("UPDATE accounts SET username='$newusername' WHERE id='$id'");
    $stmt->execute();
}

if ($status = false) {
    echo 'error';
} else {
    /**
     * ここはprofile.phpに戻ったときに更新された内容を表示したいので、SESSIONを書き換える必要があります！
     */
    $_SESSION['name'] = $newusername;
    header('Location: profile.php');
}
