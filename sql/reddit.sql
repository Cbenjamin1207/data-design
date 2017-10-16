INSERT INTO `user`(userId, userEmail, userName) VALUES(1100100111010110, somedude@place.com, yeet);
DELETE FROM `user` WHERE userName LIKE "%eet";
UPDATE `user` SET userEmail = "otherdude@place.com", userName = "ya boi";
SELECT userName, userHash FROM `user` WHERE userEmail = "otherdude@place.com";

INSERT INTO post(postContent, postTitle, postUserId) VALUES("I write some things", "This is my post", "ya boi");
DELETE FROM post WHERE postDate = "2017-10-12 08:52:15:651176";
UPDATE post SET postContent = "Updated written things";
SELECT postUserId, postTitle, postDate FROM post WHERE postId =1101101100010010;

INSERT INTO comment(commentContent, commentPostId, commentUserId) VALUES("I think things sometimes," 1101101100010010,
	1100100111010110);
DELETE FROM comment WHERE commentDate = "2016-11-25 09:40:23:927382";
UPDATE comment SET commentContent = "I don't ever think things" WHERE commentUserId = 1100100111010110;
SELECT commentCommentId, commentContent, commentId WHERE commentDate = "2016-11-25 09:40:23:927382";