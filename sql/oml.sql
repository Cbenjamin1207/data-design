INSERT INTO `user`(userId, userEmail, userName, userHash, userSalt)
	VALUES(UNHEX(REPLACE("61873282-20ad-4556-ad8d-f21d4aaa34ae", "-", "")), "somedude@place.com", "yeet",
		"epMtz2zMKTS8WS0v0AzAII497UJ22B7FKT5fX2r9qiKcsyHXBulVA5v4uyj3VoCR4d781qYNxi9y2EeU8tbVqp1tTkfZwkwreBV50cmfxW51Z9KM97EFJbNvQTp2mwoA",
		"ze3PDF5xyBhrPKc2zg4Pmz6hfp4e2mVrNqhAabbJgyrs2AycAa8bYTVKhVwLtznB");
DELETE FROM `user` WHERE userName LIKE "%eet";
UPDATE `user` SET userName = "ya boi" WHERE userEmail LIKE "somedude%";
SELECT userName, userHash FROM `user` WHERE userEmail = "otherdude@place.com";

INSERT INTO post(postContent, postTitle, postDateTime, postId, postUserId)
	VALUES("I write some things", "This is my post", '2017-10-12 08:52:15.651176',
		UNHEX(REPLACE("a892c0b0-a525-4d7e-921a-9de06c36e833", "-", "")),
		UNHEX(REPLACE("61873282-20ad-4556-ad8d-f21d4aaa34ae", "-", "")));
DELETE FROM post WHERE postDateTime = '2017-10-12 08:52:15.65117';
UPDATE post SET postDateTime = '2017-07-20 11:06:30.65237' WHERE postUserId =
	UNHEX(REPLACE("61873282-20ad-4556-ad8d-f21d4aaa34ae", "-", ""));
SELECT postUserId, postTitle, postDateTime FROM post WHERE postId =
	UNHEX(REPLACE("a892c0b0-a525-4d7e-921a-9de06c36e833", "-", ""));

INSERT INTO comment(commentContent, commentPostId, commentUserId, commentId, commentDateTime)
	VALUES("I think things sometimes", UNHEX(REPLACE("a892c0b0-a525-4d7e-921a-9de06c36e833", "-", "")),
		UNHEX(REPLACE("61873282-20ad-4556-ad8d-f21d4aaa34ae", "-", "")),
		UNHEX(REPLACE("7b8cbeca-0b7b-467a-b013-7fa0a39cbb05", "-", "")),
		'2016-11-25 09:40:23.927382');
DELETE FROM comment WHERE commentDateTime = '2016-11-25 09:40:23.927382';
UPDATE comment SET commentDateTime = '2016-11-26 10:25:23.392817' WHERE commentUserId =
	UNHEX(REPLACE("61873282-20ad-4556-ad8d-f21d4aaa34ae", "-", ""));
SELECT commentContent, commentId FROM comment WHERE commentDateTime = '2016-11-25 09:40:23.927382';