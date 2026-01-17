<?php
session_start();
function connect_to_db()
{
  $dbn = 'mysql:dbname=gs_php_dev;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

// ログイン状態のチェック関数
function check_session_id()
{
  if(!isset($_SESSION['session_id']) || $_SESSION['session_id'] !== session_id()) {
    header('location: todo_login.php');
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION['session_id'] = session_id();
  }
}

// 管理者判別
function check_admin_id()
{
  if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    // 一般ユーザー
    header('location: todo_read.php');
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION['session_id'] = session_id();
  }
}
