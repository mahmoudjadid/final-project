CREATE TABLE `users`(
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255),
    `email`  VARCHAR(255) unique
);

CREATE TABLE `posts`(
    `post_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT ,
    `post_title` VARCHAR(255),
    `post_content` VARCHAR(255),
     FOREIGN KEY (`user_id`) REFERENCES users(`user_id`) 
);	

CREATE TABLE `comments`(
	`post_id` INT,
    `user_id` INT,
    `comments_id` INT AUTO_INCREMENT PRIMARY KEY,
    `content` 	VARCHAR(255),
    FOREIGN KEY (`user_id`) REFERENCES users(`user_id`),
    FOREIGN KEY (`post_id`) REFERENCES posts(`post_id`)
);

INSERT INTO `USERS` VALUES (1, "JOE DOE", "JEODEO@HOTMAIL.COM"),
                          (2, "JOHN SMITH", "JOHN-SMITH@HOTMAIL.COM"),
                          (3, "HULK HOGAN", "HULKHOGAN@HOTMAIL.COM"),
                          (4, "UNDER TAKER", "UNDERTAKER@HOTMAIL.COM");
                          
INSERT INTO `posts` VALUES  (11,1, "THIS IS THE 11TH POST", "ORDER SUPPLEIS " ), 
                            (22,2, "THIS IS THE 22TH POST", "ORDER PIZZA " ),
                            (33,3, "THIS IS THE 33TH POST", "ORDER CHICKEN & FRIES " ),
                            (44,4, "THIS IS THE 44TH POST", "ORDER BEEF BBQ " ),
                            (12,1, "THIS IS THE 12TH POST", "ORDER PASTA " ),
                            (34,3, "THIS IS THE 34TH POST", "ORDER BACKED POTATO " );

INSERT INTO `COMMENTS` VALUES (11,1, 1, "THIS IS THE FIRST COMMENT FOR POST 11"),
                              (11,2, 2, "THIS IS THE SECOND COMMENT FOR POST 11"),
                              (22,2, 3, "THIS IS THE FIRST COMMENT FOR POST 22"),
                              (33,3, 4, "THIS IS THE FIRST COMMENT FOR POST 33"),
                              (44,4, 5, "THIS IS THE FIRST COMMENT FOR POST 44"),
                              (12,1, 6, "THIS IS THE FIRST COMMENT FOR POST 12"),
                              (34,3, 7, "THIS IS THE FIRST COMMENT FOR POST 34");


-- cd /c/Users/mahmo/OneDrive/Desktop/SeFactory/Final-Project