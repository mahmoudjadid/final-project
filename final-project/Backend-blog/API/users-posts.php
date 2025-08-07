<?php

include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$input = file_get_contents("php://input");
$data = json_decode($input, true);
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!isset($data['user_id'])) {
    http_response_code(400); 
    echo json_encode(['error' => 'user_id is required.']);
    exit;
}

$user_id = intval($data['user_id']); 

$stmt = $connection->prepare("
    SELECT post_id, post_title, post_content
    FROM posts
    WHERE user_id = ?
    ORDER BY post_id DESC
    LIMIT 10
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$stmt->close();
$connection->close();

header('Content-Type: application/json');
echo json_encode($posts);

?>