<?php
// session変数を定義して値を入れよう
session_start();

$_SESSION['text'] = '今日のご飯は？';
$_SESSION['number'] = '1122';
$_SESSION['array'] = ['React', 'Typescript', 'NextJS'];

var_dump($_SESSION);
exit();