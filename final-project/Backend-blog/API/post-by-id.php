<?php

include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$input = file_get_contents("php://input");
$data = json_decode($input, true);
}

if (!isset($data['post_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'post_id is required.']);
    exit;
}

$post_id = intval($data['post_id']);

$post_stmt = $connection->prepare("
    SELECT posts.post_id, posts.post_title, posts.post_content, users.user_name
    FROM posts
    LEFT JOIN users ON posts.user_id = users.user_id
    WHERE posts.post_id = ?
");
$post_stmt->bind_param("i", $post_id);
$post_stmt->execute();
$post_result = $post_stmt->get_result();

if ($post_result->num_rows === 0) {
    http_response_code(404); 
    echo json_encode(['error' => 'Post not found.']);
    exit;
}

$post_data = $post_result->fetch_assoc();
$post_stmt->close();

$comment_stmt = $connection->prepare("
    SELECT comments.comments_id, comments.content, users.user_name
    FROM comments
    LEFT JOIN users ON comments.user_id = users.user_id
    WHERE comments.post_id = ?
    ORDER BY comments.comments_id DESC
    LIMIT 15
");
$comment_stmt->bind_param("i", $post_id);
$comment_stmt->execute();
$comment_result = $comment_stmt->get_result();

$comments = [];
while ($row = $comment_result->fetch_assoc()) {
    $comments[] = $row;
}
$comment_stmt->close();

$response = [
    'post' => $post_data,
    'latest_comments' => $comments
];

header('Content-Type: application/json');
echo json_encode($response);

$connection->close();

?>