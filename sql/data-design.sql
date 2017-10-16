-- Drops tables to remove errors
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS comment;

-- Creates a table for the user, and all attributes
CREATE TABLE `user` (
	userId BINARY(16) NOT NULL,
	userEmail CHAR(32) NOT NULL,
	userHash CHAR(128) NOT NULL,
	userName VARCHAR(32) NOT NULL,
	userSalt CHAR(64) NOT NULL,
	UNIQUE(userEmail),
	UNIQUE(userName),
	PRIMARY KEY(userId)
);

-- Creates a table for the post, and all attributes
CREATE TABLE post (
	postId BINARY(16) NOT NULL,
	postUserId BINARY(16) NOT NULL,
	postTitle VARCHAR(128) NOT NULL,
	postContent VARCHAR(65535) NOT NULL,
	postDate DATETIME(6) NOT NULL,
	INDEX(postUserId),
	FOREIGN KEY(postUserId) REFERENCES `user`(userId),
	PRIMARY KEY(postID)
);

-- Creates a table for the comment, and all attributes.
CREATE TABLE comment (
	commentId BINARY(16) NOT NULL,
	commentPostId BINARY(16) NOT NULL,
	commentUserId BINARY(16) NOT NULL,
	commentCommentID BINARY(16),
	commentDate DATETIME(6) NOT NULL,
	commentContent VARCHAR(65535) NOT NULL,
	INDEX(commentPostId),
	INDEX(commentUserID),
	INDEX(commentCommentId),
	FOREIGN KEY(commentPostId) REFERENCES post(postId),
	FOREIGN KEY(commentUserId) REFERENCES `user`(userId),
	FOREIGN KEY(commentCommentId) REFERENCES comment(commentId),
	PRIMARY KEY(commentId)
);