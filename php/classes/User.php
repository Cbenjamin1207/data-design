<?php

/**
 * An individual user on the site
 *
 * @author Calder Benjamin <calderbenjamin@gmail.com>
 */
class User implements \JsonSerializable {

	/**
	 *ID for this user, the primary key
	 *
	 * @var Uuid $userId
	 */
	private $userId;

	/**
	 * The email associated with this user
	 *
	 * @var string $userEmail
	 */
	private $userEmail;

	/**
	 * The hash of this user's password
	 *
	 * @var string $userHash
	 */
	private $userHash;

	/**
	 * The salt for this user's password
	 *
	 * @var string $userSalt
	 */
	private $userSalt;

	/**
	 *The user's display name
	 *
	 * @var string $userName
	 */
	private $userName;

	/**
	 * Constructor for this user
	 *
	 * @param Uuid $newUserId the ID for the user
	 * @param string $newUserEmail the email associated with the user
	 * @param string $newUserHash the hash of this user's password
	 * @param string $newUserSalt the salt for this user's password
	 * @param string $newUserName the user's display name
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function _construct($newUserId, $newUserEmail, $newUserHash, $newUserSalt, $newUserName) {
		try {
			$this->setUserId($newUserId);
			$this->setUserEmail($newUserEmail);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserSalt);
			$this->setUserName($newUserName);
		}
		catch(\InvalidArgumentException|\RangeException|\Exception|\TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user ID
	 *
	 * @return Uuid value of user ID
	 */
	public function getUserId(): Uuid {
		return($this->userId);
	}

	/**
	 * mutator method for user ID
	 *
	 * @param Uuid $newUserId new value of user's ID
	 */
	public function setUserId($newUserId): void {
		$this->userId = $newUserId;
	}

	/**
	 * accessor method for user Email
	 *
	 * @return string Email of the user
	 */
	public function getUserEmail(): string {
		return($this->userEmail);
	}

	/**
	 * mutator method for user Email
	 *
	 * @param string $newUserEmail User's new email
	 * @throws \InvalidArgumentException if $newUserEmail is not a string or insecure
	 * @throws \TypeError if $newUserEmail is not a string
	 */
	public function setUserEmail($newUserEmail): void {
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("Email is not valid or is insecure"));
		}

		$this->userEmail = $newUserEmail;
	}

	/**
	 * accessor method for userHash
	 *
	 * @return string Hash of the user
	 */
	public function getUserHash(): string {
		return($this->userHash);
	}

	/**
	 * mutator method for userHash
	 *
	 * @param string $newUserHash User's new Hash
	 * @throws \InvalidArgumentException if hash is not in hexit form
	 * @throws \RangeException if hash is not exactly 128 characters
	 */
	public function setUserHash($newUserHash): void {
		$newUserHash = trim($newUserHash);
		$newUserHash = strtolower($newUserHash);
		if(!ctype_xdigit($newUserHash)) {
			throw(new \InvalidArgumentException("User Hash is not in hexit form."));
		}
		if(strlen($newUserHash) !== 128) {
			throw(new \RangeException("User Hash does not contain 128 characters."));
		}

		$this->userHash = $newUserHash;
	}

	/**
	 * accessor method for userSalt
	 *
	 * @return string Salt of the user
	 */
	public function getUserSalt() : string {
		return($this->userSalt);
	}

	/**
	 * mutator method for usersalt
	 *
	 * @param string $newUserSalt User's new salt
	 * @throws \InvalidArgumentException if salt is not in hexit form
	 * @throws \RangeException if salt is not exactly 64 characters
	 */
	public function setUserSalt($newUserSalt): void {
		$newUserSalt = trim($newUserSalt);
		$newUserSalt = strtolower($newUserSalt);
		if(!ctype_xdigit($newUserSalt)) {
			throw(new \InvalidArgumentException("User Salt is not in hexit form."));
		}
		if(strlen($newUserSalt) !== 64) {
			throw(new \RangeException("User Salt does not contain 64 characters."));
		}
		$this->userSalt = $newUserSalt;
	}

	/**
	 * accessor method for userName
	 *
	 * @return string User's display name
	 */
	public function getUserName() : string {
		return($this->userName);
	}

	/**
	 * mutator method for userName
	 *
	 * @param string $newUserName The user's new display name
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 32 characters
	 * @throws \TypeError if $newUserName is not a string
	 */
	public function setUserName($newUserName) : void {
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING);
		if(empty($newTweetContent) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		if(strlen($newUserName) > 32) {
			throw(new \RangeException("username too large"));
		}
		$this->userName = $newUserName;
	}

	/**
	 * Inserts this user into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {
		$query = "INSERT INTO `user`(userId, userEmail, userName, userHash, userSalt) 
			VALUES(:userId, :userEmail, :userName, :userHash, :userSalt)";
		$statement = $pdo->prepare($query);

		$parameters = ["userId" => $this->userId->getBytes(), "userEmail" => $this->userEmail,
			"userName" => $this->userName, "userHash" => $this->userHash, "userSalt" => $this->userSalt];
		$statement->execute($parameters);
	}

	/**
	 * Deletes this user from mySql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM `user` WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["userId" => $this->userId->getBytes()];
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

		// create query template
		$query = "UPDATE `user` SET userEmail = :userEmail, userHash = :userHash, userSalt = :userSalt,
			userName = :userName WHERE userId = :userId";
		$statement = $pdo->prepare($query);


		$parameters = ["userId" => $this->userId->getBytes(),"userEmail" => $this->userEmail,
			"userHash" => $this->userHash, "userSalt" => $this->userSalt, "userName" => $this->userName];
		$statement->execute($parameters);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["userId"] = $this->userId->toString();

		return($fields);
	}
}