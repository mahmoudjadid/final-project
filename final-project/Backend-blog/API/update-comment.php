<?php

include('../connection.php');

if ($_SERVER ['REQUEST_METHOD']==='put'){
    $data = json_decode (file_get_contents("php://input"), true);

}
if (!isset($data['comment_id']) || !isset($data['content'])) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'comment_id and content are required.']);
        exit;
    }

$comment_id = intval($data['comment_id']);    
$content= trim($data['content']);

$statement = $connection->prepare ("update comments set content = ? where comments_id = ?");
$statement->bind_param("si", $content , $comment_id);

$success = $statement->execute();

if ($success) {
        echo json_encode(['message' => 'Comment updated successfully.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to update comment.']);
    }

$statement->close();
$connection->close();



?>
