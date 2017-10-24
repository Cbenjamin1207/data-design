<?php

/**
 * A post created by a User
 *
 * A post has both a title and content, users can use the post title as an index.
 *
 * @author Calder Benjamin <calderbenjamin@gmail.com>
 */
class Post implements \JsonSerializable {
	use validateDate;
	use validateUuid;

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
	 * @var \DateTime $postDateTime
	 */
	private $postDateTime;

	/**
	 * Constructor method for Post class
	 *
	 * @param Uuid $newPostId The ID of the post
	 * @param Uuid $newPostUserId The ID of the user who created the post
	 * @param string $newPostTitle The title of the post
	 * @param string $newPostContent The content of the post
	 * @param \DateTime $newPostDateTime The date and time the post was created
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct($newPostId, $newPostUserId, string $newPostTitle, string $newPostContent,
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
	 * @param Uuid $newPostId the new value of the post ID
	 */
	public function setPostId($newPostId): void {
		try {
			$uuid = self::validateUuid($newPostId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postId = $uuid;
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
	 * @param Uuid $newPostUserId the new value of the post creator's ID
	 */
	public function setPostUserId($newPostUserId): void {
		try {
			$uuid = self::validateUuid($newPostUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postUserId = $uuid;
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
	 * @param string $newPostTitle the new title of the post
	 * @throws \InvalidArgumentException if $newPostTitle is not a string or insecure
	 * @throws \TypeError if $newPostTitle is not a string
	 * @throws \RangeException if $newPostTitle is longer than 128 characters
	 */
	public function setPostTitle(string $newPostTitle): void {
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
	 * @param string $newPostContent the new content of the post
	 * @throws \InvalidArgumentException if $newPostContent is not a string or insecure
	 * @throws \TypeError if $newPostContent is not a string
	 */
	public function setPostContent(string $newPostContent): void {
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
	 * @return \DateTime the date and time the post was created
	 */
	public function getPostDateTime(): \DateTime {
		return ($this->postDateTime);
	}

	/**
	 * mutator method for postDateTime
	 *
	 * @param \DateTime $newPostDateTime the new date and time the post was created
	 */
	public function setPostDateTime($newPostDateTime): void {
		if($newPostDateTime === null) {
			$this->postDateTime = new \DateTime();
			return;
		}
		try {
			$newPostDateTime = self::validateDateTime($newPostDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postDateTime = $newPostDateTime;
	}

	/**
	 * Inserts this post into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {
		$query = "INSERT INTO post(postId, postUserId, postTitle, postContent, postDateTime) 
			VALUES(:postId, :postUserId, :postTitle, :postContent, :postDateTime)";
		$statement = $pdo->prepare($query);

		$formattedDate = $this->postDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["postId" => $this->postId->getBytes(), "postUserId" => $this->postUserId->getBytes(),
			"postTitle" => $this->postTitle, "postContent" => $this->postContent, "postDateTime" => $formattedDate];
		$statement->execute($parameters);
	}

	/**
	 * Deletes this post from mySql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) : void {
		$query = "DELETE FROM post WHERE postId = :postId";
		$statement = $pdo->prepare($query);

		$parameters = ["postId" => $this->postId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this user in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		$query = "UPDATE post SET postTitle = :postTitle, postContent = :postContent, postDateTime = :postDateTime 
			WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		$formattedDate = $this->postDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["postId" => $this->postId->getBytes(),"postTitle" => $this->postTitle,
			"postContent" => $this->postContent, "postDateTime" => $formattedDate];
		$statement->execute($parameters);
	}

	/**
	 * gets the post by postId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param  $postId post ID to search for
	 * @return Post|null post found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getPostByPostId(\PDO $pdo, $postId) : ?post {
		try {
			$postId = self::validateUuid($postId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		$query = "SELECT postId, postUserId, postTitle, postContent, postDateTime FROM post 
			WHERE postId = :postId";
		$statement = $pdo->prepare($query);

		$parameters = ["postId" => $postId->getBytes()];
		$statement->execute($parameters);

		try {
			$post = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$post = new Post($row["postId"], $row["postUserId"], $row["postTitle"], $row["postContent"],
					$row["postDateTime"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($post);
	}

	/**
	 * gets the post by postUserId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param $postUserId post user id to search for
	 * @return Post|null user found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getPostByPostUserId(\PDO $pdo, $postUserId) : ?post {
		try {
			$postUserId = self::validateUuid($postUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		$query = "SELECT postId, postUserId, postTitle, postContent, postDateTime FROM post 
			WHERE postUserId = :postUserId";
		$statement = $pdo->prepare($query);

		$parameters = ["postId" => $postUserId->getBytes()];
		$statement->execute($parameters);

		try {
			$post = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$post = new Post($row["postId"], $row["postUserId"], $row["postTitle"], $row["postContent"],
					$row["postDateTime"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($post);
	}

	/**
	 * gets all posts
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Tweets found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllPosts(\PDO $pdo) : \SPLFixedArray {
		$query = "SELECT postId, postUserId, postTitle, postContent, postDateTime FROM post";
		$statement = $pdo->prepare($query);
		$statement->execute();

		$posts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$post = new Post($row["postId"], $row["postUserId"], $row["postTitle"], $row["postContent"],
					$row["postDateTime"]);
				$post[$posts->key()] = $post;
				$posts->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($posts);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["postId"] = $this->postId->toString();
		$fields["postUserId"] = $this->postUserId->toString();

		//format the date so that the front end can consume it
		$fields["postDateTime"] = round(floatval($this->postDateTime->format("U.u")) * 1000);
		return($fields);
	}
}