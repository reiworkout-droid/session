<?php
// データ受け取り
include('functions.php');
session_start();

// SQL実行
$sql = 'SELECT * FROM users_table WHERE username=:username AND password = :password AND deleted_at is NULL';

$username = $_POST['username'];
$password = $_POST['password'];

// DB接続
$pdo = connect_to_db();

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// ユーザ有無で条件分岐

$user = $stmt->fetch(PDO::FETCH_ASSOC);//一つを取り出す


if (!$user) {
    echo "<p>ログイン情報に誤りがあります。</p>";
    echo "<a href = todo_login.php>ログイン</a>";
    exit();
} else {
    $_SESSION = array();
    $_SESSION['session_id'] =  session_id();
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['username'];
    header('location:todo_read.php');
    exit();
}