<?php
    $dsn = 'mysql:host=103.193.177.64;dbname=mindspaze';
    $username = 'mindspaze';
    $password = '';

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function getStrFromQuill($jsonQuill) {
        $quillJSON = $jsonQuill;
        $quillData = json_decode($quillJSON, true);
        $textQuill = '';

        foreach ($quillData['ops'] as $op) {
            if (isset($op['insert']) && is_string($op['insert']) && !isset($op['attributes'])) {
                $textQuill .= strip_tags($op['insert']);
            }
        }

        $textQuill = str_replace("\n", "", $textQuill);

        return $textQuill;
    }


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
    
                $stmt = $pdo->prepare($updateSql);
                $stmt->execute([
                    'classification_status' => $ai_classification,
                    'answer_id' => $answerId
                ]);
            }
        }
    } else {
        echo "Invalid response format.";
    }

    

    } catch (PDOException $e) {
        echo $e;
    }
?>










