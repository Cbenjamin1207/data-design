<?php

/**
 * A post created by a User
 *
 * @author Calder Benjamin <calderbenjamin@gmail.com>
 */
class Post {

	/**
	 * ID for this post; primary key
	 *
	 * @var Uuid postId
	 */
	private $postId;

	/**
	 * ID of the user who created the post; foreign key
	 *
	 * @var Uuid postUserId
	 */
	private $postUserId;

	/**
	 * Title of the post
	 *
	 * @var string postTitle
	 */
	private $postTitle;

	/**
	 * Content of the post
	 *
	 * @var string postContent
	 */
	private $postContent;

	/**
	 * Date and time the post was created
	 *
	 * @var DateTime postDateTime
	 */
	private $postDateTime;
}