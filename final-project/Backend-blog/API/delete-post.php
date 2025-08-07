<?php

include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['post_id'])) {
        http_response_code(400); 
        echo json_encode(['error' => 'post_id is required.']);
        exit;
    }

    $post_id = intval($data['post_id']);

    $statement = $connection->prepare("DELETE FROM posts WHERE post_id = ?");
    $statement->bind_param("i", $post_id);

    $success = $statement->execute();

    header('Content-Type: application/json');

    if ($success && $statement->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Post deleted successfully.']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Post not found or could not be deleted.']);
    }

    $statement->close();
    $connection->close();

} else {
    http_response_code(405);
    echo json_encode(['error' => 'Only DELETE requests are allowed.']);
}

?>