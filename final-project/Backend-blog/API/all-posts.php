<?php

include('../connection.php');

$sql= " select
    posts.post_id,
    posts.post_title,
    posts.post_content,
    users.user_name,
    count(comments.comments_id) as comment_count
    from posts
    left join users on posts.user_id = users.user_id
    left join comments on posts.post_id = comments.post_id
    group by posts.post_id , posts.post_title, posts.post_content, users.user_name
    order by posts.post_id desc";
    
$result = $connection->query($sql);

$_posts = [];

while ($row = $result->fetch_assoc()){
    $_posts[] = $row;
}

header('content-type: application/json');
echo json_encode($_posts);

?>