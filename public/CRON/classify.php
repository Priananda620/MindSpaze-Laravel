<?php
$dsn = 'mysql:host=103.193.177.64;dbname=mindspaze';
$username = 'mindspaze';
$password = '';

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// echo $_SERVER['HTTP_ORIGIN'];

// $url = $_SERVER['HTTP_ORIGIN'] . "/api/thread/add-reaction";
// $headers = array(
//     'Content-Type: application/json',
//     'Accept: application/json',
//     'Authorization: Bearer ' . $_COOKIE['api_plain_token']
// );
// $data = array(
//     'answer_id' => $_POST['answer_id'],
//     'reaction_emoji' => $_POST['reaction_emoji']
// );

// $options = array(
//     'http' => array(
//         'header' => $headers,
//         'method' => 'POST',
//         'content' => json_encode($data),
//         'timeout' => 5 // Timeout in seconds
//     )
// );

// $context = stream_context_create($options);
// $response = file_get_contents($url, false, $context);

// if ($response !== false) {
//     // Request succeeded
//     $responseData = json_decode($response, true);
//     echo $response;
//     // Perform any further actions with the response data
// } else {
//     // Request failed
//     echo "Failed to make the HTTP request.";
//     // Handle the error appropriately
// }

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
    // echo 1111;

    // Query to update is_hot_thread for qualifying questions
    $sql = "
    SELECT id, answer_synopsis
    FROM answers
    WHERE ai_classification_status IS NULL";

    $stmt = $pdo->query($sql);
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare the data for the API request
    $requestData = [];
    foreach ($answers as $answer) {
        $requestData[$answer['id']] = getStrFromQuill($answer['answer_synopsis']);
        // echo $answer['id'];
    }

    // Convert the request data to JSON
    $jsonData = json_encode($requestData);

    echo $jsonData;

////////////////
    $apiEndpoint = "{YOUR_API_ENDPOINT}";
    $response = // Make the HTTP request to your API using your preferred method

    // Process the response and update the related rows in the database
    $decodedResponse = json_decode($response, true);
//////////////





foreach ($decodedResponse as $answerId => $classification) {
    if ($classification === true) {
        $updateSql = "
        UPDATE answers
        SET ai_classification_status = 1
        WHERE id = :answer_id
        AND ai_classification_status IS NULL";
    } else {
        $updateSql = "
        UPDATE answers
        SET ai_classification_status = 0
        WHERE id = :answer_id
        AND ai_classification_status IS NULL";
    }

    $stmt = $pdo->prepare($updateSql);
    $stmt->execute(['answer_id' => $answerId]);
}

echo "Rows updated successfully.";

} catch (PDOException $e) {
    // Handle any database errors
    // echo "Database Error: " . $e->getMessage();
}
?>










