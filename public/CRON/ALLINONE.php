<?php
$dsn = 'mysql:host=103.193.177.64;dbname=mindspaze';
$username = 'mindspaze';
$password = '';

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


<?php


try {

    // Query to update is_bolt_user for qualifying users
    $sqlBolt = "UPDATE users
    SET is_bolt_user = 1
    WHERE id IN (
        SELECT user_id
        FROM answers
        WHERE moderated_as = 1
        GROUP BY user_id
        HAVING COUNT(*) >= 5)";

    // Execute the update query
    $pdo->exec($sqlBolt);


    $sqlResetHotThread = "
    UPDATE questions 
    SET isHotThread = 0";

    // Execute the reset query
    $pdo->exec($sqlResetHotThread);


    $sqlHotThread = "
    UPDATE questions 
    SET isHotThread  = 1
    WHERE id IN (
        SELECT question_id
        FROM answers 
        WHERE created_at >= NOW() - INTERVAL 1 DAY
        GROUP BY question_id
        HAVING COUNT(*) >= 5)";

    // Execute the update query
    $pdo->exec($sqlHotThread);

} catch (PDOException $e) {
    // Handle any database errors
    // echo "Database Error: " . $e->getMessage();
}
?>
