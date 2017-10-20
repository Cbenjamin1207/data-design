<?php

/**
 * A post created by a User
 *
 * @author Calder Benjamin <calderbenjamin@gmail.com>
 */
class Post implements \JsonSerializable {
	use validateDate;

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
	public function _construct($newPostId, $newPostUserId, $newPostTitle, $newPostContent,
										$newPostDateTime = null) {
		try {
			$this->setPostId($newPostId);
			$this->setPostUserId($newPostUserId);
			$this->setPostTitle($newPostTitle);
			$this->setPostContent($newPostContent);
			$this->setPostDateTime($newPostDateTime);
		} catch(\InvalidArgumentException|\RangeException|\Exception|\TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for postId
	 *
	 * @return Uuid value of the post ID
	 */
	public function getPostId(): Uuid {
		return ($this->postId);
	}

	/**
	 * mutator method for postId
	 *
	 * @var Uuid $newPostId the new value of the post ID
	 */
	public function setPostId($newPostId): void {
		$this->postId = $newPostId;
	}

	/**
	 * accessor method for postUserId
	 *
	 * @return Uuid value of the post creator's ID
	 */
	public function getPostUserId(): Uuid {
		return ($this->postUserId);
	}

	/**
	 * mutator method for postUserId
	 *
	 * @var Uuid $newPostUserId the new value of the post creator's ID
	 */
	public function setPostUserId($newPostUserId): void {
		$this->postUserId = $newPostUserId;
	}

	/**
	 * accessor method for postTitle
	 *
	 * @return string the title of the post
	 */
	public function getPostTitle(): string {
		return ($this->postTitle);
	}

	/**
	 * mutator method for postTitle
	 *
	 * @var string $newPostTitle the new title of the post
	 * @throws \InvalidArgumentException if $newPostTitle is not a string or insecure
	 * @throws \TypeError if $newPostTitle is not a string
	 * @throws \RangeException if $newPostTitle is longer than 128 characters
	 */
	public function setPostTitle($newPostTitle): void {
		$newPostTitle = trim($newPostTitle);
		$newPostTitle = filter_var($newPostTitle, FILTER_SANITIZE_STRING);
		if(empty($newPostTitle) === true) {
			throw(new \InvalidArgumentException("Post title is empty or insecure"));
		}
		if(strlen($newPostTitle) > 128) {
			throw(new \RangeException("Post title is too long"));
		}
		$this->postTitle = $newPostTitle;
	}

	/**
	 * accessor method for postContent
	 *
	 * @return string the content of the post
	 */
	public function getPostContent(): string {
		return ($this->postContent);
	}

	/**
	 * mutator method for postContent
	 *
	 * @var string $newPostContent the new content of the post
	 * @throws \InvalidArgumentException if $newPostContent is not a string or insecure
	 * @throws \TypeError if $newPostContent is not a string
	 */
	public function setPostContent($newPostContent): void {
		$newPostContent = trim($newPostContent);
		$newPostContent = filter_var($newPostContent, FILTER_SANITIZE_STRING);
		if(empty($newPostContent) === true) {
			throw(new \InvalidArgumentException("Post content is empty or insecure"));
		}
		$this->postContent = $newPostContent;
	}

	/**
	 * accessor method for postDateTime
	 *
	 * @return DateTime the date and time the post was created
	 */
	public function getPostDateTime(): DateTime {
		return ($this->postDateTime);
	}

	/**
	 * mutator method for postDateTime
	 *
	 * @var DateTime $newPostDateTime the new date and time the post was created
	 */
	public function setPostDateTime($newPostDateTime): void {
		if($newPostDateTime === null) {
			$this->postDateTime = new DateTime();
			return;
		}
		$this->postDateTime = $newPostDateTime;
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["tweetId"] = $this->tweetId->toString();
		$fields["tweetProfileId"] = $this->tweetProfileId->toString();

		//format the date so that the front end can consume it
		$fields["tweetDate"] = round(floatval($this->tweetDate->format("U.u")) * 1000);
		return($fields);
	}
}