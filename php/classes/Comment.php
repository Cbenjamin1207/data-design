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

	/**
	 * Constructor for this class
	 *
	 * @param Uuid $newCommentId the new ID of the comment
	 * @param Uuid $newCommentPostId the new ID of the comment's post
	 * @param Uuid $newCommentUserId the new ID of the comment's creator
	 * @param Uuid $newCommentCommentId the new ID of the comment's comment
	 * @param DateTime $newCommentDateTime the new date and time the comment was posted
	 * @param string $newCommentContent the new content of the comment
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function _construct($newCommentId, $newCommentPostId, $newCommentUserId, $newCommentCommentId,
										$newCommentDateTime = null, $newCommentContent) {
		try {
			$this->setCommentId($newCommentId);
			$this->setCommentPostId($newCommentPostId);
			$this->setCommentUserId($newCommentUserId);
			$this->setCommentCommentId($newCommentCommentId);
			$this->setCommentDateTime($newCommentDateTime);
			$this->setCommentContent($newCommentContent);
		}
		catch(\InvalidArgumentException|\RangeException|\Exception|\TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for commentId
	 *
	 * @return Uuid the ID of the comment
	 */
	public function getCommentId() : Uuid {
		return($this->commentId);
	}

	/**
	 * mutator method for commentId
	 *
	 * @var Uuid $newCommentId the new ID of the comment
	 */
	public function setCommentId($newCommentId) : void {
		$this->commentId = $newCommentId;
	}

	/**
	 * accessor method for commentPostId
	 *
	 * @return Uuid the ID of the comment's psot
	 */
	public function getCommentPostId() : Uuid {
		return($this->commmentPostId);
	}

	/**
	 * mutator method for commentPostId
	 *
	 * @var Uuid $newCommentPostId the new ID of the comment's post
	 */
	public function setCommentPostId($newCommentPostId) : void {
		$this->commmentPostId = $newCommentPostId;
	}

	/**
	 * accessor method for commentUserId
	 *
	 * @return Uuid the ID of the comment's creator
	 */
	public function getCommentUserId() : Uuid {
		return($this->commentUserId);
	}

	/**
	 * mutator method for commentUserId
	 *
	 * @var Uuid $newCommentUserId the new ID of the comment's creator
	 */
	public function setCommentUserId($newCommentUserId) : void {
		$this->commentUserId = $newCommentUserId;
	}

	/**
	 * accessor method for commentCommentId
	 *
	 * @return Uuid the ID of the comment's comment
	 */
	public function getCommentCommentId() : Uuid {
		return($this->commentCommentId);
	}

	/**
	 * mutator method for commentCommentId
	 *
	 * @var Uuid $newCommentCommentId the new ID fo the comment's comment
	 */
	public function setCommentCommentId($newCommentCommentId) : void {
		$this->commentCommentId = $newCommentCommentId;
	}

	/**
	 * accessor method for commentDateTime
	 *
	 * @return DateTime the date and time the comment was created
	 */
	public function getCommentDateTime() : DateTime {
		return($this->commentDateTime);
	}

	/**
	 * mutator method for commentDateTime
	 *
	 * @var DateTime $newCommentDateTime the new date and time the comment was created
	 */
	public function setCommentDateTime($newCommentDateTime) : void {
		if($newCommentDateTime === null) {
			$this->postDateTime = new DateTime();
			return;
		}
		$this->commentDateTime = $newCommentDateTime;
	}
}