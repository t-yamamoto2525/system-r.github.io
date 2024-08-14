<?php
include 's_db_inc.php';  // データベース接続用のファイルをインクルード

// HTTPリクエストがPOSTの場合のみ処理を行う
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTデータから日報の日付と内容を取得
    $report_date = $_POST['report_date'];
    $content = $_POST['content'];

    // データベースに日報データを挿入するSQL文の準備
    $stmt = $pdo->prepare("INSERT INTO reports (report_date, content) VALUES (?, ?)");
    
    // SQL文を実行し、データベースにデータを保存
    $stmt->execute([$report_date, $content]);

    // 日報が保存されたことをユーザーに通知
    echo "日報が保存されました。";
}

// データベースから日報の一覧を取得するSQL文
$sql = "SELECT * FROM reports ORDER BY report_date DESC";
$stmt = $pdo->query($sql);

// データを取得してHTMLに表示
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>日報の投稿と一覧</title>
</head>
<body>
    <h1>日報の入力</h1>
    <form method="post">
        <label for="report_date">日付:</label>
        <input type="date" id="report_date" name="report_date" required><br><br>

        <label for="content">内容:</label><br>
        <textarea id="content" name="content" rows="5" cols="40" required></textarea><br><br>

        <button type="submit">保存</button>
    </form>

    <h2>日報一覧</h2>
    <table border="1">
        <tr>
            <th>日付</th>
            <th>内容</th>
            <th>作成日時</th>
        </tr>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['report_date'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8')) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>