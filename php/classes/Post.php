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
	 * @var Uuid $postId
	 */
	private $postId;

	/**
	 * ID of the user who created the post; foreign key
	 *
	 * @var Uuid $postUserId
	 */
	private $postUserId;

	/**
	 * Title of the post
	 *
	 * @var string $postTitle
	 */
	private $postTitle;

	/**
	 * Content of the post
	 *
	 * @var string $postContent
	 */
	private $postContent;

	/**
	 * Date and time the post was created
	 *
	 * @var DateTime $postDateTime
	 */
	private $postDateTime;

	/**
	 * Constructor method for Post class
	 *
	 * @param Uuid $newPostId The ID of the post
	 * @param Uuid $newPostUserId The ID of the user who created the post
	 * @param string $newPostTitle The title of the post
	 * @param string $newPostContent The content of the post
	 * @param DateTime $newPostDateTime The date and time the post was created
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function _construct($newPostId, $newPostUserId, $newPostTitle, $newPostContent, $newPostDateTime) {
		try {
			$this->setPostId($newPostId);
			$this->setPostUserId($newPostUserId);
			$this->setPostTitle($newPostTitle);
			$this->setPostContent($newPostContent);
			$this->setPostDateTime($newPostDateTime);
		}
		catch(\InvalidArgumentException|\RangeException|\Exception|\TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for postId
	 *
	 * @return Uuid value of the post ID
	 */
	public function getPostId() : Uuid {
		return($this->postId);
	}

	/**
	 * mutator method for postId
	 *
	 * @var Uuid $newPostId the new value of the post ID
	 */
	public function setPostId($newPostId) : void {
		$this->postId = $newPostId;
	}


}