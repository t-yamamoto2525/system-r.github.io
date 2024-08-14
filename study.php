<?php
include 's_db_inc.php';
$sql = "SELECT * FROM shared_items";
// データベースへ問合せのSQL($sql)を実行
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);

$category = '勉強会';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $file_path = null;

    // ファイルのアップロード処理
    if (!empty($_FILES['file']['name'])) {
        $target_dir = "uploads/";
        $file_path = $target_dir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    }

    $stmt = $pdo->prepare("INSERT INTO shared_items (category, title, content, file_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$category, $title, $content, $file_path]);

    echo "投稿が保存されました。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>勉強会 - 投稿</title>
</head>
<body>
    <h1>勉強会 - 投稿</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">内容:</label><br>
        <textarea id="content" name="content" rows="5" cols="40" required></textarea><br><br>

        <label for="file">ファイル:</label>
        <input type="file" id="file" name="file"><br><br>

        <button type="submit">投稿する</button>
    </form>
</body>
</html>