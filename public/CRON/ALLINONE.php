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


    ///////////////////////////////////////////////////////////////////////////////

    try {
        $sql = "
        SELECT id, answer_synopsis
        FROM answers
        WHERE ai_classification_status IS NULL";

        $stmt = $pdo->query($sql);
        $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $requestData = [
            "answers" => []
        ];

        foreach ($answers as $answer) {
            $requestData["answers"][$answer['id']] = getStrFromQuill($answer['answer_synopsis']);
        }

        $jsonData = json_encode($requestData);

        echo $jsonData;

        ////////////////////////////////////////////////


        $url = 'http://103.193.177.64/predict';
        $headers = array(
            'Content-Type: application/json'
        );

        $options = array(
            'http' => array(
                'header'  => $headers,
                'method'  => 'POST',
                'content' => $jsonData
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        echo "<br><br>-----------------------------<br>";
        echo $response;

        $responseData = json_decode($response, true);



        if (isset($responseData['data']['is_hoax'])) {
            $classificationData = $responseData['data']['is_hoax'];
        
            foreach ($classificationData as $answerId => $classification) {
                if ($classification == true || $classification == false && $classification !== []) {
                    
                    $ai_classification = $classification?1:0;
                    echo $answerId . " => " . $ai_classification . "<br>";
        
        
                    $updateSql = "
                        UPDATE answers
                        SET ai_classification_status = :classification_status
                        WHERE id = :answer_id
                        AND ai_classification_status IS NULL";
        
                    $stmt2 = $pdo->prepare($updateSql);
                    $stmt2->execute([
                        'classification_status' => $ai_classification,
                        'answer_id' => $answerId
                    ]);
                }else{
                    echo "empty!";
                }
            }
        } else {
            echo "Invalid response format.";
        }

    

    } catch (PDOException $e) {
        echo $e;
    }

} catch (PDOException $e) {
    // Handle any database errors
    // echo "Database Error: " . $e->getMessage();
}
?>
