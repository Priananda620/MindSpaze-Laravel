<?php
$dsn = 'mysql:host=103.193.177.64;dbname=mindspaze';
$username = 'mindspaze';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to update is_hot_thread for qualifying questions
    $sql = "
    UPDATE questions 
    SET isHotThread  = 1
    WHERE id IN (
        SELECT question_id
        FROM answers 
        WHERE created_at >= NOW() - INTERVAL 1 DAY
        GROUP BY question_id
        HAVING COUNT(*) >= 5)";

    // Execute the update query
    $pdo->exec($sql);

    echo "Question table updated successfully.";

} catch (PDOException $e) {
    // Handle any database errors
    echo "Database Error: " . $e->getMessage();
}
?>