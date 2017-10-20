<?php

/**
 * A comment created on a post
 *
 * @author Calder Benjamin <calderbenjamin@gmail.com>
 */
class Content {

	/**
	 * ID for this comment; primary key
	 *
	 * @var Uuid $commentId
	 */
	private $commentId;

	/**
	 * ID for this comment's post; foreign key
	 *
	 * @var Uuid $commentPostId
	 */
	private $commmentPostId;

	/**
	 * ID for this comment's user; foreign key
	 *
	 * @var Uuid $commentUserId
	 */
	private $commentUserId;

	/**
	 * Comment for this comment's comment; foreign key; can be NULL
	 *
	 * @var Uuid $commentCommentId
	 */
	private $commentCommentId;

	/**
	 * Date and time the comment was posted
	 *
	 * @var DateTime $commentDateTime
	 */
	private $commentDateTime;

	/**
	 * Content of the comment
	 *
	 * @var string $commentContent
	 */
	private $commentContent;


}