<?php
// sessionをスタートしてidを再生成しよう．
// 旧idと新idを表示しよう．
session_start();

$id = session_id();

session_regenerate_id(true);
$new_id = session_id();
var_dump($id);
var_dump($new_id);
exit();