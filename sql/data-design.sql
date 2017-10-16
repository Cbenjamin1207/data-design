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

CREATE TABLE comment (
	commentId
)