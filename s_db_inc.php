<?php 
  //$conn = new mysqli("localhost", "root", "", "wp2024");//＜開発時の環境設定＞
  //$conn = new mysqli("localhost","k22rs149","System_research");//＜運用時の環境設定＞
  //if ($conn->connect_errno) die($conn->connect_error);
  //$conn->set_charset('utf8'); //文字コードをutf8に設定（文字化け対策）
$host = 'localhost';
$dbname = 'System_Research';
$username = 'root';  // ← ここに正しいデータベースのユーザー名を入力してください
$password = '';  // ← ここに正しいデータベースのパスワードを入力してください

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続に失敗しました: ' . $e->getMessage();
    exit();
}
?>
